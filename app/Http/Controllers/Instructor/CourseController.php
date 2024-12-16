<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
Use App\Models\Category;
use App\Models\Level;
use App\Models\Price;
use App\Models\Subcategory;
use App\Models\TeacherPayment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CourseController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('user_id', Auth::user()->id)->get();
        $teacher_payment = TeacherPayment::all();
        //$promedioReviews = $this->calcularPromedio($course = null);

        return view('instructor.courses.index', compact('courses', 'teacher_payment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $levels = Level::all();
        $prices = Price::all();

        return view('instructor.courses.create', compact('categories', 'levels', 'prices', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses', // Ensure slug is unique
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
            'subcategories' => 'required'
        ]);

        $data['user_id'] = Auth::user()->id;
        $course = Course::create($data);
        $course->subcategories()->attach($request->subcategories);

        return redirect()->route('instructor.courses.edit', $course);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $this->authorize('author', $course);

        $categories = Category::all();
        $levels = Level::all();
        $prices = Price::all();

        return view('instructor.courses.edit', compact('course', 'categories', 'levels', 'prices'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $this->authorize('author', $course);

        $data = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:courses,slug,' . $course->id, // Ensure slug is unique
            'summary' => 'nullable|max:1000',
            'description' => 'nullable',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'price_id' => 'required|exists:prices,id',
            'subcategories' => 'required'
        ]);

        //return $request->all();

        if($request->hasFile('image')) {

            if($course->image_path) {
                // Delete the old image
                Storage::delete($course->image_path);
            }

            $data['image_path'] = Storage::put('courses/images', $request->file('image'));

        }

        $course->update($data);

        //actualizar las subcategorias
        $course->subcategories()->sync($request->subcategories);

        //session()->flash('flash.bannerStyle', 'danger');
        session()->flash('flash.banner', 'El curso se actualizo correctamente');
        return redirect()->route('instructor.courses.edit', $course);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        //
    }

    public function video(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.video', compact('course'));
    }   

    public function goals(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.goals', compact('course'));
    }

    public function requirements(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.requirements', compact('course'));
    }

    public function curriculum(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.curriculum', compact('course'));
    }

    public function students(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.students', compact('course'));
    }

    public function status(Course $course)
    {
        $this->authorize('author', $course);

        if($course->lessons()->count() < 10) {
            session()->flash('flash.banner', 'El curso debe tener al menos diez lecciones');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('instructor.courses.edit', $course);
        }
        if($course->goals()->count() < 3) {
            session()->flash('flash.banner', 'El curso debe tener al menos tres objetivos');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('instructor.courses.edit', $course);
        }
        if($course->requirements()->count() < 3) {
            session()->flash('flash.banner', 'El curso debe tener al menos tres requisitos');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('instructor.courses.edit', $course);
        }
        if($course->sections()->count() < 5) {
            session()->flash('flash.banner', 'El curso debe tener al menos cinco secciones en el curriculum');
            session()->flash('flash.bannerStyle', 'danger');
            return redirect()->route('instructor.courses.edit', $course);
        }

        $course->status = 2;
        $course->save();

        $course->observation()->delete();

        return redirect()->route('instructor.courses.edit', $course);
    }

    public function observations(Course $course)
    {
        $this->authorize('author', $course);
        return view('instructor.courses.observations', compact('course'));
    }

    public function selected($category)
    {
        $subcategories = Subcategory::where('category_id', $category)->get();

        return response()->json($subcategories);
    }

    //Calcular el promedio de las calificaciones
    static function calcularPromedio($course)
    {
        //return $course->reviews;
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
