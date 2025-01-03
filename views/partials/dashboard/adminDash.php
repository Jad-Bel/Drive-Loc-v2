<?php 
session_start();
require_once "../../../includes/session_check.php";
require_once "../../../models/user.php";
require_once "../../../models/user.php";


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - DriveLoc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 56px;
            background-color: #f8f9fa;
            z-index: 100;
        }
        .main-content {
            margin-left: 200px;
            padding-top: 56px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: static;
                height: auto;
                padding-top: 0;
            }
            .main-content {
                margin-left: 0;
            }
        }
        .error-message {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">DriveLoc Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person-circle"></i> Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../includes/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="col-md-3 col-lg-2 sidebar">
        <div class="position-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#statistics">
                        <i class="bi bi-graph-up"></i> Statistics
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#reservations">
                        <i class="bi bi-calendar-check"></i> Reservations
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#vehicles">
                        <i class="bi bi-truck"></i> Vehicles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#users">
                        <i class="bi bi-people"></i> Users
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
        <!-- Statistics Section -->
        <section id="statistics" class="mt-4">
            <h2>Statistics</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text display-4">150</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Vehicles</h5>
                            <p class="card-text display-4">50</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Active Reservations</h5>
                            <p class="card-text display-4">25</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Revenue</h5>
                            <p class="card-text display-4">$10,000</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Reservations Section -->
        <section id="reservations" class="mt-4">
            <h2>Reservations</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Vehicle</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Toyota Camry</td>
                        <td>2023-05-01</td>
                        <td>2023-05-05</td>
                        <td>Pending</td>
                        <td>
                            <button class="btn btn-sm btn-success">Accept</button>
                            <button class="btn btn-sm btn-danger">Decline</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>Honda Civic</td>
                        <td>2023-05-03</td>
                        <td>2023-05-07</td>
                        <td>Accepted</td>
                        <td>
                            <button class="btn btn-sm btn-secondary" disabled>Accept</button>
                            <button class="btn btn-sm btn-danger">Cancel</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Vehicles Section -->
        <section id="vehicles" class="mt-4">
            <h2>Vehicles</h2>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addVehicleModal">Add Vehicle</button>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Price per Day</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Toyota</td>
                        <td>Camry</td>
                        <td>2022</td>
                        <td>$50</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editVehicleModal">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Honda</td>
                        <td>Civic</td>
                        <td>2021</td>
                        <td>$45</td>
                        <td>
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editVehicleModal">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- Users Section -->
        <section id="users" class="mt-4">
            <h2>Users</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Registration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>john@example.com</td>
                        <td>2023-01-15</td>
                        <td>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Jane Smith</td>
                        <td>jane@example.com</td>
                        <td>2023-02-20</td>
                        <td>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>

    <!-- Add Vehicle Modal -->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" aria-labelledby="addVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVehicleModalLabel">Add New Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVehicleForm">
                        <div class="mb-3">
                            <label for="vehicleMake" class="form-label">Make</label>
                            <input type="text" class="form-control" id="vehicleMake" required>
                            <div class="error-message" id="vehicleMakeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleModel" class="form-label">Model</label>
                            <input type="text" class="form-control" id="vehicleModel" required>
                            <div class="error-message" id="vehicleModelError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="vehicleYear" required>
                            <div class="error-message" id="vehicleYearError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehiclePrice" class="form-label">Price per Day</label>
                            <input type="number" class="form-control" id="vehiclePrice" required>
                            <div class="error-message" id="vehiclePriceError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="addVehicleButton">Add Vehicle</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Vehicle Modal -->
    <div class="modal fade" id="editVehicleModal" tabindex="-1" aria-labelledby="editVehicleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editVehicleModalLabel">Edit Vehicle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editVehicleForm">
                        <div class="mb-3">
                            <label for="editVehicleMake" class="form-label">Make</label>
                            <input type="text" class="form-control" id="editVehicleMake" value="Toyota" required>
                            <div class="error-message" id="editVehicleMakeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleModel" class="form-label">Model</label>
                            <input type="text" class="form-control" id="editVehicleModel" value="Camry" required>
                            <div class="error-message" id="editVehicleModelError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleYear" class="form-label">Year</label>
                            <input type="number" class="form-control" id="editVehicleYear" value="2022" required>
                            <div class="error-message" id="editVehicleYearError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehiclePrice" class="form-label">Price per Day</label>
                            <input type="number" class="form-control" id="editVehiclePrice" value="50" required>
                            <div class="error-message" id="editVehiclePriceError"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="editVehicleButton">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/validation.js"></script>
</body>
</html>

