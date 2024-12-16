<?php

namespace App\Models;

use App\Observers\LessonObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


#[ObservedBy(LessonObserver::class)]
class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'platform',
        'video_path',
        'video_original_name',
        'image_path',
        'description',
        'duration',
        'order',
        'is_published',
        'is_preview',
        'is_processed',
        'section_id',
    ];

    public $casts = [
        'is_published' => 'boolean',
        'is_preview' => 'boolean',
        'is_processed' => 'boolean',
    ];

    protected function lessonCompleted(): Attribute
    {
        return new Attribute(
            get: function () {
                if (Auth::check()) {
                    $user = $this->users()->where('user_id', Auth::user()->id);
                    if ($user->exists()) {

                        $completed = DB::table('lesson_user')
                            ->where('lesson_id', $this->id)
                            ->first();
                        
                        return $completed->is_completed;
                    }
                }
                return false;
            },
        );
    }

    //Accesor para la url de la imagen
    public function image(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->platform == 1) {
                    return Storage::url($this->image_path);
                }else{
                    return $this->image_path;
                }
            
            },
        );
    }

    /**
     * Relación uno a muchos inversa
     */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    
    //relacion muchos a muchos con user
    public function users()
    {
        return $this->belongsToMany(User::class, 'lesson_user');
    }

    //relacion uno a uno con el modelo resource
    public function resource()
    {
        return $this->hasOne(Resource::class);
    }

    //Relacion uno a muchos polimorfica
    public function questions(){
        return $this->morphMany(Question::class, 'questionable');
    }
}
