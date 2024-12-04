<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance History</title>

    <!-- Custom Css -->
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/student.css') }}" rel="stylesheet">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
</head>
<body>
    <!-- Navbar top -->
    <div class="navbar-top">
        <div class="title">
            <h1>Attendance History</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li>
                <a href="#sign-out">
                    <i class="fa fa-sign-out-alt fa-2x"></i>
                </a>
            </li>
        </ul>
        <!-- End -->
    </div>
    <!-- End -->

    <!-- Sidenav -->
    <div class="sidenav">
        <div class="profile">
            @if(empty($user->profile_picture))
            <img src="{{ asset('images/logo.png') }}" alt="Profile Picture" width="100" height="100">
            @else
            <img src="{{ Storage::url($user->profile_picture) }}" alt="Profile Picture" width="100" height="100">
            @endif

            <div class="name">
                {{$user->username}}
            </div>
            <div class="job">
                {{$user->class}}
            </div>
        </div>
    </div>
    <!-- End -->

    <!-- Main -->
    <div class="main">
        <h2>Attendance Details</h2>
        <div class="card">
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Register Number</th>
                            <th>Attendance Marked At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attendanceRecords as $record)
                            <tr>
                                <td>{{$record->stud_name}}</td>
                                <td>{{$record->student_id}}</td>
                                <td>{{$record->date_of_attendance}}</td>
                                <td>{{$record->attendance}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- End -->

</body>
</html>
