<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display students
        return view('students.index');
    }
}
