<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

//Enviar email
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedCourse;
use App\Mail\RejectCourse;

class CourseController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $courses = Course::where('status', 2)
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('admin.courses.index', compact('courses'));
    }

    //Para utilizar $this->authorize() debemos incluir: use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    public function show(Course $course)
    {
        $this->authorize('approved', $course);

        return view('admin.courses.show', compact('course'));
    }

    public function approve(Course $course)
    {
        $this->authorize('approved', $course);

        //dd($course->description, $course->goals, $course->sections);
        if($course->description == null || $course->goals->count() < 1 || $course->sections->count() < 1){

            //para crear el mensaje flash con estulos se deben enviar las dos lineas de codigo, 
            //en una linea se define el mensaje y en otra el estilo del banner
            session()->flash('flash.banner', 'No se puede aprobar el curso');
            session()->flash('flash.bannerStyle', 'danger');

            return redirect()->route('admin.courses.show', $course);
        }

        $course->status = 3;
        $course->save();

        //Enviar correo electronico
        $mail = new ApprovedCourse($course);
        Mail::to($course->teacher->email)->queue($mail);

        return redirect()->route('admin.courses.index')->with('success', 'El curso se aprobo con exito.');
    
    }

    public function observation(Course $course)
    {
        // return 1;
        return view('admin.courses.observation', compact('course'));
    }

    public function reject(Request $request, Course $course)
    {
        $request->validate([
            'content' => 'required'
        ]);

        $course->observation()->create($request->all());
        $course->status = 1;
        $course->save();

        //Enviar correo electronico
        $mail = new RejectCourse($course);
        Mail::to($course->teacher->email)->queue($mail);

        return redirect()->route('admin.courses.index')->with('success', 'Las observaciones se guardaron con exito.');

        //esto es para testear la vista del email
        //return view('mail.reject-course', compact('course'));
    }

}
