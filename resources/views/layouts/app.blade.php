<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin-bottom: 5px;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background-color: rgb(19, 14, 14);
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .logout-button {
            background-color: rgb(19, 14, 14);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            text-align: left;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h4>{{ config('app.name', 'Laravel') }}</h4>
        <nav>
            @can('department-list')
                <a href="{{ route('departments.index') }}">Departments</a>
            @endcan
            @can('student-list')
                <a href="{{ route('students.index') }}">Students</a>
            @endcan
            @can('user-list')
                <a href="{{ route('users.index') }}">Manage Users</a>
            @endcan
            @can('role-list')
                <a href="{{ route('roles.index') }}">Manage Role</a>
            @endcan
            <a href="{{ route('reports.index') }}">Report</a>
            <!-- Add more links if needed -->
        </nav>

        <!-- Logout Form -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-button">Logout</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')

        <!-- Footer -->
        <footer class="text-center mt-5">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
