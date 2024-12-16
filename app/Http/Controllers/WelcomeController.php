<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Traits\SeoPageTrait;

//Enviar email
use Illuminate\Support\Facades\Mail;
use App\Mail\TeacherFormApproved;
use App\Models\User;


class WelcomeController extends Controller
{
    use SeoPageTrait;
    public function index()
    {
        $courses = Course::orderBy('id', 'desc')->take(6)->get();

        $posts = Post::orderBy('created_at', 'desc')->take(4)->get();
        
        $categories = Category::all();

        $courseTime = [];

        foreach ($courses as $course) {

            //duracionn del curso en segundos
            $duration = $course->lessons->where('is_published', '=', 1)->sum('duration');

            //Calcular horas, minutos y segundos
            $horas = floor($duration / 3600);
            $minutos = floor(($duration % 3600) / 60);
            $segundos = $duration % 60;
            $totalTime = sprintf('%2dh %02dm', $horas, $minutos);

            $courseTime[$course->id] = $totalTime;
        }

        /**
         * seotools : https://github.com/artesaos/seotools
         * Este metodo se encuentra en el trait SeoPageTrait
         */
        $this->generateIndexSeoPage('welcome');

        //return $courseTime;
        return view('welcome', compact('courses', 'courseTime', 'posts', 'categories'));
    }

    public function formInstructor()
    {
        $register = DB::table('form_instructor')->where('user_id', Auth::user()->id)->get();
        $register_exist = count($register);
        //$status = $register[0]->status;
        if ($register_exist == 0) {
            $status = 0;
        }else{
            $status = $register[0]->status;
        }
        
        /**
         * seotools : https://github.com/artesaos/seotools
         * Este metodo se encuentra en el trait SeoPageTrait
         */
        $this->generateIndexSeoPage('form-instructor');

        return view('pages.form-instructor', compact('status', 'register_exist'));
    }

    public function sendFormInstructor(Request $request)
    {

        $data = $request->validate([
            'tema' => 'required',
            'categorias' => 'required',
            'subcategorias' => 'required',
        ]);

        $data['user_id'] = Auth::user()->id;
        $data['user_name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $data['fecha'] = date('Y-m-d');

        DB::insert('insert into form_instructor (tema, categorias, subcategorias, user_id, email, user_name, fecha) values (?, ?, ?, ?, ?, ?, ?)', [
            $data['tema'],
            $data['categorias'],
            $data['subcategorias'],
            $data['user_id'],
            $data['email'],
            $data['user_name'],
            $data['fecha']
        ]);

        //enviar email a mi cuenta
        $mail = new TeacherFormApproved($data);
        Mail::to(User::find(1)->email)->queue($mail);

        return redirect()->route('pages.formInstructor')->with('success', 'Formulario enviado correctamente');
    }

    public function indexFormInstructor()
    {
        $forms = DB::table('form_instructor')->get();

        return view('mail.teacher-form-approved', compact('forms'));
    }

    /**
     * Pages: 
     * Conviertete-en-istructor
     * politica de privacidad
     */
    public function infoInstructor()
    {
        /**
         * seotools : https://github.com/artesaos/seotools
         * Este metodo se encuentra en el trait SeoPageTrait
         */
        $this->generateIndexSeoPage('info-instructor');
        return view('pages.info-instructor');
    }

    public function politicaPrivacidad()
    {
        $this->generateIndexSeoPage('politica-privacidad');
        return view('pages.privacidad');
    }

    public function terminosCondiciones()
    {
        $this->generateIndexSeoPage('condiciones');
        return view('pages.condiciones');
    }

    public function politicaCookies()
    {
        $this->generateIndexSeoPage('politica-cookies');
        return view('pages.cookies');
    }
    
}
