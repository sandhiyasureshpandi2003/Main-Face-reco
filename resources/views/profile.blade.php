<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>

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
            <h1>Profile</h1>
        </div>

        <!-- Navbar -->
        <ul>
            <li class="nav-list">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-2x"></i>
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
        <h2>IDENTITY</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <tbody>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            @if($user->hasRole('student'))
                            <td>Student</td>
                            @elseif($user->hasRole('teacher'))
                            <td>Teacher</td>
                            @else
                            <td>Admin</td>
                            @endif
                            
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{$user->username}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        @if($user->hasRole('student'))
                        <tr>
                            <td>Class</td>
                            <td>:</td>
                            <td>{{$user->class}}</td>
                        </tr>
                        <tr>
                            <td>Register No</td>
                            <td>:</td>
                            <td>{{$user->reg_no}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td>{{$user->phone_number}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>