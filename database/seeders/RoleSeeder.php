<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin         = Role::create(['name' => 'admin']);
        $role_editor_post    = Role::create(['name' => 'editor_post']);
        $role_instructor    = Role::create(['name' => 'instructor']);
        $role_student       = Role::create(['name' => 'student']);
        

        //Permisos exclusivos admin
        Permission::create([
            'name' => 'admin.home', 
        ])->syncRoles([$role_admin]);

        Permission::create([
            'name' => 'Eliminar cursos', 
        ])->syncRoles([$role_admin]);


        //Permisos editar post
        Permission::create([
            'name' => 'Ver posts',
        ])->syncRoles([$role_admin, $role_editor_post]);
        Permission::create([
            'name' => 'Crear posts',
        ])->syncRoles([$role_admin, $role_editor_post]);
        Permission::create([
            'name' => 'Editar posts'
        ])->syncRoles([$role_admin, $role_editor_post]);
        Permission::create([
            'name' => 'Actualizar posts'
        ])->syncRoles([$role_admin, $role_editor_post]);
        Permission::create([
            'name' => 'Eliminar posts'
        ])->syncRoles([$role_admin, $role_editor_post]);


        //Permisos menú instructor
        Permission::create([
            'name' => 'Ver cursos', 
        ])->syncRoles([$role_admin, $role_instructor]);

        Permission::create([
            'name' => 'Crear cursos', 
        ])->syncRoles([$role_admin, $role_instructor]);

        Permission::create([
            'name' => 'Editar cursos'
        ])->syncRoles([$role_admin, $role_instructor]);

        Permission::create([
            'name' => 'Actualizar cursos'
        ])->syncRoles([$role_admin, $role_instructor]);

        //permisos menú student
        Permission::create([
            'name' => 'Escribir comentarios'
        ])->syncRoles([$role_admin, $role_instructor, $role_student, $role_editor_post]);

    }
}
