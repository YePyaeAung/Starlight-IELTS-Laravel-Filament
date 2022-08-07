<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('welcome', compact('courses'));
    }
    public function registration()
    {
        $courses = Course::all();
        return view('registration', compact('courses'));
    }

    public function registrationPost()
    {
        $data = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('registrations', 'email')],
            'phone' => ['required', Rule::unique('registrations', 'phone')],
            'date_of_birth' => ['required'],
            'address' => ['required'],
            'course_id' => ['required'],
        ]);
        $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
        Registration::create($data);
        return redirect()->route('home');
    }
}
