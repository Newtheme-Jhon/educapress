<?php

namespace App\Http\Controllers\Admin;

use App\Enums\FormInstructorStatus;
use App\Http\Controllers\Controller;
use App\Mail\ApprovedTeacherEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class TeacherApprovedController extends Controller
{
    public function index()
    {
        $requests = DB::table('form_instructor')->get();
        //dd($solicitudes);
        return view('admin.teachers.index', compact('requests'));
    }

    public function show($id)
    {
        $request = DB::table('form_instructor')->where('id', $id)->first();
        return view('admin.teachers.show', compact('request'));
    }

    public function destroy($id)
    {
        $request = DB::table('form_instructor')->where('id', $id)->delete();
        return redirect()->route('admin.teachers.index')->with('success', 'Solicitud eliminada correctamente');
    }

    public function emailApproved($id){

        // Actualizar el estado en la base de datos
        DB::table('form_instructor')
        ->where('id', $id)
        ->update(['status' => FormInstructorStatus::APROBADO]);

        $response = DB::table('form_instructor')->where('id', $id)->first();

        //debo añadir status a la tabla

        //enviar email
        $mail = new ApprovedTeacherEmail($response);
        Mail::to($response->email)->queue($mail);

        return redirect()->route('admin.teachers.approved.index')->with('success', 'Email enviado correctamente');
    }
}
