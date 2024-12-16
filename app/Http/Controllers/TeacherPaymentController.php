<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeacherPaymentController extends Controller
{
    public function index()
    {
        //return 1;
        return view('admin.teachers-payments.index');
    }
}
