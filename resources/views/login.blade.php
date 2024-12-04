<!DOCTYPE html>
<html lang="en">
<head>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div id="gradient-bg">
        <div class="gradient-container">
            <center><h1 class="title">Face Recognition Attendance Management system</h1></center>
            <div class="gradient1"></div>
            <div class="gradient2"></div>
            <div class="gradient3"></div>
            <div class="gradient4"></div>
            <div class="gradient5"></div>
        </div>
    </div>
    <div id="form-container">
        
        <h1 class="title">Sign in</h1>
        
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="label">Username</div>
            <input type="text" name="username" required />
            
            <div class="label">Password</div>
            <input type="password" name="password" required />
            
            <input type="submit" class="submit" value="Sign in" />
        </form>
        <div class="label msg">◆ You don't have an account? <a href="{{ route('register.form') }}">Sign up</a></div>
    </div>
</body>
</html>
