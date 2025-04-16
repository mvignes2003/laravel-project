@extends('layouts.app')

@section('content')
<!-- Card & Table Section -->
<div class="container mt-3">
    <div class="row">
        <!-- Left Column: Cards -->
        <div class="col-md-3">
            <!-- Department Count Card -->
            <div class="card text-white bg-primary mt-5 shadow">
                <div class="card-header">Departments</div>
                <div class="card-body">
                    <p class="card-text">Total Departments</p>
                    <h5 class="card-title">{{ $departmentCount }}</h5>
                </div>
            </div>

            <!-- Student Count Card -->
            <div class="card text-white bg-success mt-5 shadow">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <p class="card-text">Total Students</p>
                    <h5 class="card-title">{{ $studentCount }}</h5>
                </div>
            </div>
        </div>

        <!-- Right Column: Table -->
        <div class="col-md-9">
            <h4>Department-wise Student Count</h4>
            <div class="table-responsive mt-3">
                <table id="departmentTable" class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>NO</th>
                            <th>Department Name</th>
                            <th>Student Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $index => $dept)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $dept->name }}</td>
                                <td>
                                    <a href="{{ route('departments.students', $dept->id) }}">
                                        {{ $dept->students_count }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="container mt-5">
    <h4 class="mb-4">Department-wise Student Count (Chart)</h4>
    <div style="height: 500px;">
        <canvas id="deptStudentChart"></canvas>
    </div>
</div>

<!-- DataTables + Chart.js Scripts -->
@stack('scripts')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    $(document).ready(function () {
        $('#departmentTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: false
        });
    });

    const ctx = document.getElementById('deptStudentChart').getContext('2d');
    const deptStudentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($departmentNames),
            datasets: [{
                label: 'Student Count',
                data: @json($studentCounts),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.9)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'x',
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 60,
                        minRotation: 60,
                        font: {
                            size: 14
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: context => `${context.parsed.y} students`
                    }
                }
            }
        }
    });
</script>

@endsection

{{-- @extends('layouts.app') <!-- or your layout -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Department Count Card -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-header">Departments</div>
                <div class="card-body">
                    <p class="card-text">Total Departments</p>
                    <h5 class="card-title">{{ $departmentCount }}</h5>
                </div>
            </div>
        </div>

        <!-- Student Count Card -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header">Students</div>
                <div class="card-body">
                    <p class="card-text">Total Students</p>
                    <h5 class="card-title">{{ $studentCount }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Add this in your Blade file (inside your layout or in this file) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<div class="container mt-4">
    <h4>Department-wise Student Counts</h4>
    <div class="table-responsive">
        <table id="departmentTable" class="table table-bordered table-striped mt-3">
            <thead class="table-dark">
                <tr>
                    <th>NO</th>
                    <th>Department Name</th>
                    <th>Student Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($departments as $index => $dept)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dept->name }}</td>
                        <td><a href="{{ route('departments.students', $dept->id) }}">{{ $dept->students_count }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@Stack('scripts')
<script>
    $(document).ready(function () {
        $('#departmentTable').DataTable({
            paging: true,
            searching: true,
            info: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: false
        });
    });
</script>
<div class="container mt-5">
    <h4 class="mb-4">Department-wise Student Counts</h4>
    <!-- Adjust height based on content -->
    <div style="height: 600px;"> <!-- You can increase this if needed -->
        <canvas id="deptStudentChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('deptStudentChart').getContext('2d');
    const deptStudentChart = new Chart(ctx, {
        type: 'bar', // Vertical bar chart
        data: {
            labels: @json($departmentNames),
            datasets: [{
                label: 'Student Count',
                data: @json($studentCounts),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.9)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'x', // 👈 Vertical bars
            scales: {
                x: {
                    ticks: {
                        autoSkip: false,
                        maxRotation: 60, // Tilt to avoid overlap
                        minRotation: 60,
                        font: {
                            size: 14
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        font: {
                            size: 14
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                title: { display: false },
                tooltip: {
                    callbacks: {
                        label: context => `${context.parsed.y} students`
                    }
                }
            }
        }
    });
</script>

@endsection


{{-- <div class="container mt-5">
    <h4 class="mb-4">Department-wise Student Count</h4>
    <!-- Adjust height based on number of departments -->
    <div style="height: 600px;"> <!-- You can increase this if needed -->
        <canvas id="deptStudentChart"></canvas>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('deptStudentChart').getContext('2d');
    const deptStudentChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($departmentNames),
            datasets: [{
                label: 'Student Count',
                data: @json($studentCounts),
                backgroundColor: 'rgba(75, 192, 192, 0.7)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                borderRadius: 8,
                hoverBackgroundColor: 'rgba(75, 192, 192, 0.9)'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y', // Horizontal bars
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0
                    }
                },
                y: {
                    ticks: {
                        autoSkip: false,
                        font: {
                            size: 14 // 👈 Make department names more readable
                        }
                    }
                }
            },
            plugins: {
                legend: { display: false },
                title: { display: false },
                tooltip: {
                    callbacks: {
                        label: context => `${context.parsed.x} students`
                    }
                }
            }
        }
    });
</script> --}}