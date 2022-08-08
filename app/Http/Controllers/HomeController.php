<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Mark;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'profile_image' => ['required'],
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('registrations', 'email')],
            'phone' => ['required', Rule::unique('registrations', 'phone')],
            'date_of_birth' => ['required'],
            'address' => ['required'],
            'course_id' => ['required'],
        ]);
        $data['profile_image'] = request()->file('profile_image')->store('profile_images', 'public');
        $data['date_of_birth'] = date('Y-m-d', strtotime($data['date_of_birth']));
        Registration::create($data);
        return redirect()->route('home');
    }

    public function markList()
    {
        $marks = Mark::all();
        return view('mark-lists', compact('marks'));
    }
}
