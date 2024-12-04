<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;


class AdminController extends Controller
{
    public function show_student_detail_form(){
        if (Auth::check()) {  
            $user = Auth::user();
            return view('admin_dashboard', compact('user'));
        }
    }
    public function store_students_face_id(Request $request){
        $client = new Client();
        $validator = Validator::make($request->all(), [
            'reg_no' => 'required|string',
            'student_name' => 'required|string',
            'student_email' => 'required|email',
            'image' => 'required|image|mimes:jpg,jpeg,png'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $request_data = $validator->validate();

        $image = $request->file('image');
        $reg_no = $request_data['reg_no'];
        $student_name = $request_data['student_name'];
        $student_email = $request_data['student_email'];

        if (!$image->isValid()) {
            return back()->with('error', 'Invalid image');
        }

        $response = $client->post('https://api-us.faceplusplus.com/facepp/v3/detect', [
            'multipart' => [
                [
                    'name' => 'api_key',
                    'contents' => 'YNcmf1kATfYDSqTFsMGue5yMHRH3uXZn'
                ],
                [
                    'name' => 'api_secret',
                    'contents' => 'SEcus_zIEb0dZSj_HRdq_-MKpbsKdQj-'
                ],
                [
                    'name' => 'image_file',
                    'contents' => fopen($image->getRealPath(), 'r'),
                    'filename' => $image->getClientOriginalName()
                ],
                [
                    'name' => 'return_landmark',
                    'contents' => '1'
                ],
                [
                    'name' => 'return_attributes',
                    'contents' => 'gender,age'
                ]
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        $faceId = $data['faces'][0]['face_token'] ?? null;

        if ($faceId) {
            $student = DB::table('students')->where('reg_no', $reg_no)->first();
            if(empty($student)){
                DB::table('students')->insert([
                    'reg_no' => $reg_no,
                    'name' => $student_name,
                    'email' => $student_email,
                    'face_id' => $faceId
                ]);
                return back()->with('success', 'New student added successfully!');
            }else{
                DB::table('students')->where('reg_no', $reg_no)->update([
                    'name' => $student_name,
                    'email' => $student_email,
                    'reg_no' =>$reg_no,
                    'face_id' => $faceId
                    ]);
                return back()->with('success', 'Student exists , data updated successfully!');
            }
        }
        return back()->with('error', 'Failed to detect face');
    }
}
