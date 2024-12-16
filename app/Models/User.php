<?php

namespace App\Models;

use function Illuminate\Events\queueable;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;


//Laravel cashier payment stripe
use Laravel\Cashier\Billable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    use HasRoles;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'sort'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //Relación muchos a muchos
    public function courses_enrolled()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'user_id', 'course_id');
    }

    //relacion uno a muchos entre usuario y payments
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    //sobreescribir método create para asignarle el rol por defecto
    /**
     * Create a new factory instance for the model.
     *
     * @param array $attributes
     * @return static
     */
    static function create(array $attributes = [])
    {
        $user = static::query()->create($attributes);
        $studentRole = Role::findByName('student');
        $user->assignRole($studentRole);

        return $user;
    }

    //relacion uno a muchos entre usuario y reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    //relacion uno a muchos entre usuarios y post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    //Actualize data client to stripe
    protected static function booted(): void
    {
        static::updated(queueable(function (User $customer) {
            if ($customer->hasStripeId()) {
                $customer->syncStripeCustomerDetails();
            }
        }));
    }

}
