<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use CodersFree\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use App\Traits\SeoPageTrait;

class CourseController extends Controller
{
    use AuthorizesRequests, SeoPageTrait;


    public function index()
    {
        //Trait SeoPageTrait
        $this->generateIndexSeoPage('courses');

        return view('courses.index');
    }

    public function show(Course $course)
    {
        /**
         * para poder utilizar $this->authorize('published', $course); debo de incluir
         * use Illuminate\Foundation\Auth\Access\AuthorizesRequests; y despues usarlo dentro de la clase
         * use AuthorizesRequests;
         */
        $this->authorize('published', $course);

        //duracionn del curso en segundos
        $duration = $course->lessons->where('is_published', '=', 1)->sum('duration');

        //total clases publicadas
        $totalLessons = $course->lessons->where('is_published', '=', 1)->count();

        //Calcular horas, minutos y segundos
        $horas = floor($duration / 3600);
        $minutos = floor(($duration % 3600) / 60);
        $segundos = $duration % 60;

        //Formatear la salida
        $totalTime = sprintf('%2dh %02dm', $horas, $minutos);
        // dd($totalTime);

        $promedioReviews = $this->calcularPromedio($course);

        /**
         * seotools : https://github.com/artesaos/seotools
         */
        $this->generateShowSeoPage('course', $course);

        return view('courses.show', compact('course', 'totalTime', 'totalLessons', 'promedioReviews'));
    }

    public function myCourses(Request $request)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $courses = $user->courses_enrolled()->paginate(12);
            //$courses = $user->courses_enrolled;

            return view('courses.my-courses', compact('courses'));
        }else
        {
            return redirect()->route('login');
        }


    }

    public function buy(Course $course)
    {   
        /**
         * @var \CodersFree\Shoppingcart\Cart $cart
         * los nombres de las llaves del array no se deben modificar
         */

        if(Cart::instance('shopping')->count() > 0)
        {
            Cart::instance('shopping')->destroy();
        }
        
        Cart::instance('shopping');
        Cart::add([
            'id' => $course->id,
            'name' => $course->title,
            'price' => $course->price->value,
            'qty' => 1,
            'options' => [
                'image' => $course->image,
                'slug' => $course->slug,
                'teacher' => $course->teacher->name,
                'course_id' => $course->id
            ]
        ]);

        return redirect()->route('cart.index');

    }

    //enroll para curso free
    public function enroll(Course $course)
    {
        if(Auth::check())
        {
            $user = Auth::user();
            $course->students()->attach($user->id);
            return redirect()->route('courses.status', $course);
        }else
        {
            return redirect()->route('login');
        }
    }

    //Calcular el promedio de las calificaciones
    public function calcularPromedio($course)
    {
        $reviews = $course->reviews->pluck('rating');
        $totalReviews = $course->reviews->count();
        if($totalReviews > 0)
        {
            $promedioReviews = $reviews->sum() / $totalReviews;
        }else
        {
            $promedioReviews = 5;
        }

        //devolver solo dos decimales
        $promedioReviews = number_format($promedioReviews, 2);
        return $promedioReviews;

    }

}
