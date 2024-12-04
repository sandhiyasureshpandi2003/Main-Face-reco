<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/student-report.css') }}" rel="stylesheet">

    <!-- FontAwesome 5 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
    
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .filter-container {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Student Report</a>
    <div class="ml-auto">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-link" style="color: black;">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="mb-4">Attendance Overview</h1>

    <!-- Filter Form -->
    <div class="filter-container">
        <!-- Update the form to send POST request -->
<form method="POST" action="{{ route('send-selected-emails') }}">
    @csrf
    <div class="form-row">
        <div class="col">
            <input type="date" name="date" class="form-control" placeholder="Filter by Date">
        </div>
        <div class="col">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-info" id="sendSelectedEmails">
                <i class="fas fa-envelope"></i> Send Email
            </button>   
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="selectAll"> <!-- Select All Checkbox -->
                        </th>
                        <th scope="col">Register Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $student)
                        <tr>
                            <td>
                                <input type="checkbox" class="student-checkbox" name="student_ids[]" value="{{ $student->student_id }}">
                            </td>
                            <th scope="row">{{ $student->student_id }}</th>
                            <td>{{ $student->stud_name }}</td>
                            <td>{{ $student->date_of_attendance }}</td>
                            <td>{{ $student->attendance }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</form>

<!-- Add this script at the bottom of your HTML body -->
<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('.student-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
</script>

    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">
                            <input type="checkbox" id="selectAll"> <!-- Select All Checkbox -->
                        </th>
                        <th scope="col">Register Number</th>
                        <th scope="col">Student Name</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $student)
                        <tr>
                            <td>
                                <input type="checkbox" class="student-checkbox" name="student_ids[]" value="{{ $student->student_id }}">
                            </td>
                            <th scope="row">{{ $student->student_id }}</th>
                            <td>{{ $student->stud_name }}</td>
                            <td>{{ $student->date_of_attendance }}</td>
                            <td>{{ $student->attendance }}</td>
                            <td>
                                <button type="button" class="btn btn-info">
                                    <i class="fas fa-envelope"></i> Send Email
                                </button>                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Add this script at the bottom of your HTML body -->
    <script>
        document.getElementById('selectAll').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.student-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked; // Set checked state of individual checkboxes
            });
        });
    </script>
    
</div>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


</body>
</html>
