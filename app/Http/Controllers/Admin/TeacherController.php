<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeacherController extends Controller
{
    public function index(){
        //$users = User::all();
        //$teachers = Teacher::all();
        return view('admin.teachers.index');
    }
}
