
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add any additional CSS or external links if necessary -->
</head>
<body>
    <div class="container">
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        @can('department-list')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('departments.index') }}">Departments</a></li>
                            @endcan
                            @can('student-list')
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('students.index') }}">Students</a></li>
                            @endcan
                            @can('user-list')
                        <li><a class="nav-link" href="{{ route('users.index') }}">Manage Users</a></li>
                        @endcan
                        @can('role-list')
                            <li><a class="nav-link" href="{{ route('roles.index') }}">Manage Role</a></li>
                        @endcan
                        <!-- You can add more navigation items here -->
                    </ul>
                </div>
            </div>
        </nav>
<!-- resources/views/layouts/app.blade.php -->
<form action="{{ route('logout') }}" method="POST" style="position: absolute; top: 7px; right: 200px;">
    @csrf
    <button type="submit" style="padding: 10px 15px; background-color:rgb(19, 14, 14); color: white; border: none; border-radius: 5px; cursor: pointer;">
        Logout
    </button>
</form>



        <!-- Main Content Section -->
        <div class="my-4">
            @yield('content')
        </div>

        <!-- Footer (Optional) -->
        <footer class="text-center mt-5">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- You can add any additional JavaScript files or scripts here -->
</body>
</html>
