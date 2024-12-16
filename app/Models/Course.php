<?php

namespace App\Models;

use App\Enums\CourseStatus;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug', // Add the slug field
        'summary',
        'description',
        'status',
        'image_path',
        'video_path',
        'welcome_message',
        'goodbye_message',
        'observation',
        'user_id',
        'level_id',
        'category_id',
        'price_id',
        'published_at'
    ];

    protected $casts = [
        'status'        => CourseStatus::class,
        'published_at'  => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected function image():Attribute{
        return new Attribute(
            get: function($value){
                return $this->image_path ? asset('storage/'.$this->image_path) : 'https://img.freepik.com/premium-vector/default-image-icon-vector-missing-picture-page-website-design-mobile-app-no-photo-available_87543-11093.jpg?w=900';
            }
        );
    }

    protected function dateOfEnrollment():Attribute{
        return new Attribute(
            get: function($value){
                $date = DB::table('course_user')
                ->where('course_id', $this->id)
                ->where('user_id', Auth::user()->id)
                ->first()->created_at;
                
                //Formatear la fecha
                $date = new \DateTime($date);
                $date = $date->format('d/m/Y');

                return $date;
            }
        );
    }

    /**
     * Para que la relacion inversa de teacher() funcione debemos de especificar  
     * el valor de la llave foranea en la relacion, es decir, aquin debemos añadir 'user_id'
     * Esto se hace porque no tenemos un modelo teacher, el modelo es user
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function price()
    {
        return $this->belongsTo(Price::class);
    }

    //relación uno a muchos
    public function goals()
    {
        return $this->hasMany(Goal::class);
    }

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Relación muchos a muchos
     */
    public function students()
    {
        /**
         * En este relación de muchos a muchos 
         * debemos indicar el nombre de la tabla y las llaves foraneas
         */
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id')
        ->withTimestamps();
    }

    //Relacion hasManyThrough
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    //relacion uno a uno con el modelo Observation
    public function observation()
    {
        return $this->hasOne(Observation::class);
    }

    //relación uno a muchos con le modelo review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //relacion de muchos a muchos
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class, 'course_subcategory', 'course_id', 'subcategory_id');
    }

    //relacion inversa entre el modelo course y el modelo TeacherPayment
    public function teacher_payments()
    {
        return $this->hasMany(TeacherPayment::class);
    }

    
}
