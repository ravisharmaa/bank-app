<?php

namespace App\Http\Controllers;


use App\Student;

class DashboardController extends Controller
{

    public function index()
    {
        return view('dashboard.index',[
            'students' => Student::all('first_name','last_name','email','last_active_date')
        ]);
    }
}
