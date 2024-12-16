<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use App\Models\TeacherPayment;
use App\Models\User;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    protected $paypal_client_id;
    protected $paypal_client_secret;

    protected $subtotal;
    protected $tax;
    protected $total;

    public function __construct()
    {
        $this->paypal_client_id = config('services.paypal.client_id');
        $this->paypal_client_secret = config('services.paypal.client_secret');

        Cart::instance('shopping');
        $this->subtotal = Cart::subtotal() - Cart::tax('2');
        $this->tax = Cart::tax('2');
        $this->total = Cart::subtotal();

    }

    public function index()
    {   
        Cart::instance('shopping');
        $cart = Cart::content()->toArray();
        $user = User::find(Auth::user()->id);

        //mostraremos esto al hace click en el boton del carrito
        return view('cart.index', compact('cart'));
    }

    //paypal access token
    private function getAccessToken()
    {
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Basic ' . base64_encode($this->paypal_client_id . ':' . $this->paypal_client_secret)
        ];

        $response = Http::withHeaders($headers)
            ->withBody('grant_type=client_credentials')
            ->post(config('services.paypal.base_url') . '/v1/oauth2/token');

        return json_decode($response->body())->access_token;
    }

    public function paypalCreateOrder(float $amount = 10.00)
    {
        $id = uuid_create();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
            'PayPal-Request-Id' => $id
        ];

        $body = [
            'intent' => 'CAPTURE',
            'purchase_units' => [
                [
                    'reference_id' => $id,
                    'amount' => [
                        'currency_code' => 'USD',
                        'value' => number_format($amount, 2)
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders($headers)
            ->withBody(json_encode($body))
            ->post(config('services.paypal.base_url') . '/v2/checkout/orders');

        Session::put('request_id', $id);
        Session::put('order_id', json_decode($response->body())->id);

        return json_decode($response->body())->id;
        //return json_decode($response->body());

    }

    public function paypalCompleteOrder()
    {

        $url = config('services.paypal.base_url') . '/v2/checkout/orders/' . Session::get('order_id') . '/capture';
        $headers = [
            'Content-Type' => 'application/json',
            'PayPal-Request-Id' => Session::get('request_id'),
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];
        
        $response = Http::withHeaders($headers)->post($url, null);
        return json_decode($response->body());

    }

    //recuperamos la orden y procesamos los datos para almacenarlos en una tabla: payments
    public function paypalSuccess()
    {

        $url = config('services.paypal.base_url') . '/v2/checkout/orders/' . Session::get('order_id');
        $headers = [
            'Authorization' => 'Bearer ' . $this->getAccessToken(),
        ];

        $response = Http::withHeaders($headers)->get($url);
        $status = json_decode($response)->status;

        if(json_decode($response->status()) == 200 && $status == 'COMPLETED'){

            $data = json_decode($response->body());
            $payment_exists = Payment::where('payment_id', '=', $data->purchase_units[0]->payments->captures[0]->id);

            if($payment_exists->count() == 0){

                Cart::instance('shopping');
                $cart = Cart::content()->toArray();
                $courses = [];
                $course = "";
    
                foreach ($cart as $item) {
                    $course = Course::find($item['id']);
                    array_push($courses, $course->id);
                    $course->students()->attach(Auth::user()->id);

                    $teacher_payment = new TeacherPayment();

                    $teacher_payment->payment_id = $data->purchase_units[0]->payments->captures[0]->id;
                    $teacher_payment->payment_method = 'paypal';
                    $teacher_payment->payment_status = $data->status;
                    $teacher_payment->payment_amount = $course->price->value;
                    $teacher_payment->payment_teacher = $course->price->value * 0.40; //40% de beneficio para el tutor
                    $teacher_payment->payment_currency = $data->purchase_units[0]->payments->captures[0]->amount->currency_code;
                    $teacher_payment->payment_return = 0;

                    $teacher_payment->course_id = $course->id;
                    $teacher_payment->user_id = $course->teacher->id;

                    $teacher_payment->save();

                }
    
                $payment = new Payment();
                
                $payment->payment_id = $data->purchase_units[0]->payments->captures[0]->id;
                $payment->product_name = 'Cursos Online';
                $payment->quantity = Cart::count();
                $payment->amount = $data->purchase_units[0]->payments->captures[0]->amount->value;
                $payment->currency = $data->purchase_units[0]->payments->captures[0]->amount->currency_code;
                $payment->payer_name = $data->payer->name->given_name . ' ' . $data->payer->name->surname;
                $payment->payer_email = $data->payer->email_address;
                $payment->payment_status = $data->status;
                $payment->payment_method = 'paypal';
                $payment->courses = json_encode($courses);
                $payment->user_id = Auth::user()->id;
                
                $payment->save();

                //destroy cart
                Cart::destroy();
                $course = Course::find($course->id);
                return redirect()->route('courses.status', $course);

            }else{

                $user = User::find(Auth::user()->id);

                //obtengo los ids de los cursos que ha comprado y lo redirecciono al ultimo
                $course = json_decode($user->payments->last()->courses);
                $course = Course::find($course[0]);
                return redirect()->route('courses.status', $course);
            }

        }

        //return json_decode($response);

    }

    //stripe
    public function stripeCheckoutPayment()
    {

        $user = User::find(Auth::user()->id);

        \Stripe\Stripe::setApiKey(config('services.stripe.secret_key'));
        $session = \Stripe\Checkout\Session::create([
            // 'customer_email' => $user->email,
            // 'client_reference_id' => $user->stripe_id,
            'customer' => $user->stripe_id,
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'USD',
                        'product_data' => [
                            'name' => 'Cursos online'
                        ],
                        'unit_amount' => $this->total * 100, //multiplicar por 100 el total del cart
                    ],
                    'quantity' => 1,
                ],
                
            ],
            'mode' => 'payment',
            'success_url' => route('cart.stripeSuccessPayment'),
            'cancel_url' => route('cart.stripeCancelPayment'),
            
        ]);

        Session::put('session_id', $session->id);


        return redirect()->away($session->url);
    }

    public function stripeSuccessPayment()
    {

        $user = User::find(Auth::user()->id);

        //recuperando los datos de la session de pago
        $session_id = Session::get('session_id');
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret_key'));
        $session = $stripe->checkout->sessions->retrieve(
            $session_id,
            []
        );

        Cart::instance('shopping');
        $cart = Cart::content()->toArray();
        $courses = [];
        $course = "";

        foreach ($cart as $item) {
            $course = Course::find($item['id']);
            array_push($courses, $course->id);
            $course->students()->attach(Auth::user()->id);

            $teacher_payment = new TeacherPayment();

            $teacher_payment->payment_id = $session->payment_intent;
            $teacher_payment->payment_method = 'stripe';
            $teacher_payment->payment_status = $session->status;
            $teacher_payment->payment_amount = $course->price->value;
            $teacher_payment->payment_teacher = $course->price->value * 0.40; //40% de beneficio para el tutor
            $teacher_payment->payment_currency = $session->currency;
            $teacher_payment->payment_return = 0;

            $teacher_payment->course_id = $course->id;
            $teacher_payment->user_id = $course->teacher->id;

            $teacher_payment->save();
        }

        $payment = new Payment();
        
        $payment->payment_id = $session->payment_intent;
        $payment->product_name = 'Cursos Online';
        $payment->quantity = Cart::count();
        $payment->amount = $session->amount_total / 100;
        $payment->currency = $session->currency;
        $payment->payer_name = $user->name;
        $payment->payer_email = $user->email;
        $payment->payment_status = $session->status;
        $payment->payment_method = 'stripe';
        $payment->courses = json_encode($courses);
        $payment->user_id = $user->id;
        
        $payment->save();

        //destroy cart
        Cart::destroy();
        $course = Course::find($course->id);
        return redirect()->route('courses.status', $course);

    }

}
