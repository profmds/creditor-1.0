<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        //$users = User::all();
        //$teachers = Teacher::all();
        return view('admin.students.index');
    }
}
