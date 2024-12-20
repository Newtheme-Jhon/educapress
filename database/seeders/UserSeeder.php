<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Jhon Jairo',
            'email'     => 'jhonja14795@gmail.com',
            'email_verified_at' => now(),
            'password'  => bcrypt('password'), //Método encriptar contraseña
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ])->assignRole('admin');

        $users = User::factory(2)->create();

        foreach ($users as $user) {
            $user->assignRole('student');
        }
    }
}
