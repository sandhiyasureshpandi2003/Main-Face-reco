<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" integrity="sha512-q3eWabyZPc1XTCmF+8/LuE1ozpg5xxn7iO89yfSOd5/oKvyqLngoNGsx8jq92Y8eXJ/IRxQbEC+FGSYxtk2oiw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

</head>
<body>
    <div id="gradient-bg">
        <div class="gradient-container">
            <center><img src="{{ asset('images/face.gif') }}" alt="College GIF" class="right-image"></center>
            <div class="gradient1"></div>
            <div class="gradient2"></div>
            <div class="gradient3"></div>
            <div class="gradient4"></div>
            <div class="gradient5"></div>
        </div>
    <div class="container">
        <input type="checkbox" id="open-sidebar">
        <label for="open-sidebar" class="bars">
            <i class="fas fa-bars"></i>
        </label>
        <div class="sidebar">
            <div class="logo">
                <a href="https://www.vvvcollege.org/">V.V.V College</a>
                <label for="open-sidebar" class="times">
                    <i class="fas fa-times"></i>
                </label>
            </div>
            <div class="nav">
                <ul>
                    <li class="nav-list">
                        <a href="{{ route('profile') }}">
                            <i class="fas fa-user nav-link-icon"></i>
                            Profile
                        </a>
                    </li>
                    @if ($user->hasRole('student'))
                    <li class="nav-list">
                        <a href="{{ route('stud.attendance') }}">
                            <i class="fas fa-camera nav-link-icon"></i>
                            Check In
                        </a>
                    </li>
                    <li class="nav-list">
                        <a href="{{route('timetable')}}">
                            <i class="fas fa-clock"></i>
                            Timetable
                        </a>
                    </li>
                    @endif
                    @if ($user->hasRole('teacher'))
                        <li class="nav-list">
                            <a href="{{ route('attendance.history') }}">
                                <i class="fas fa-calendar-check nav-link-icon"></i>
                                Attendance History
                            </a>
                        </li>
                    @endif
                    @if($user->hasRole('admin'))
                    <li class="nav-list">
                        <a href="{{ route('admin.profile')}}">
                            <i class="fas fa-comments nav-link-icon"></i>
                            Admin
                        </a>
                    </li>
                    @endif
                    <li class="nav-list">
                        <a href="{{route('settings.show')}}">
                            <i class="fas fa-cogs nav-link-icon"></i>
                            Settings
                        </a>
                    </li>
                   
                    @if($user->hasRole('admin'))
                    <li class="nav-list">
                        <a href="{{route('stud-report')}}">
                            <i class="fas fa-question-circle nav-link-icon"></i>
                            Student Reports
                        </a>
                    </li>
                    @endif
                    <li class="nav-list">
                        <a href="#">
                            <i class="fas fa-calendar-alt nav-link-icon"></i>
                            Academic Calendar
                        </a>
                    </li>
                    <li class="nav-list">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt nav-link-icon"></i>
                            Sign Out
                        </a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>

</body>
</html>
