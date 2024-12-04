<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class AttendanceController extends Controller
{
    public function show_face_capture_form(){
        if(Auth::check()){
            $user = Auth::user();
            return view('face_capture',compact('user'));
        }
    }
    public function show_attendance_history()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $attendanceRecords = Attendance::orderBy('date_of_attendance', 'desc')
                                            ->get();
            return view('attendance_history', compact('user', 'attendanceRecords'));
        } else {
            return redirect()->route('login');
        }
    }
}
