<?php
// session_start();
require_once "../../../includes/session_check.php";
require_once "../../../models/reservation.php";
require_once "../../../models/vehicule.php";
require_once "../../../models/user.php";

$reservation = new Reservation();
$vehicules = new vehicule();
$user = new User();

$affvehicules = $vehicules->affAllVehicule();
$users = $user->affUsers();
$count = $user->countUsers();
$countVeh = $vehicules->countVeh();
$activeReservations = $reservation->activeRsv();
$reservations = $reservation->affAllReservation();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        if ($action === 'add_vehicle') {
            // Add Vehicle Logic
            $marque = $_POST['marque'];
            $vhc_name = $_POST['vhc_name'];
            $disponibilite = $_POST['disponibilite'];
            $description = $_POST['description'];
            $vhc_image = $_POST['vhc_image'];
            $model = $_POST['model'];
            $transmition = $_POST['transmition'];
            $mileage = $_POST['mileage'];
            $prix = $_POST['prix'];

            $vehicules->ajouterVeh($vehicule_id, $marque, $disponibilite, $prix, $description, $vhc_image,  $mileage, $model, $transmition, $vhc_name);
        } elseif ($action === 'edit_vehicle') {
            // Edit Vehicle Logic
            $vehicule_id = $_POST['vehicule_id'];
            $marque = $_POST['marque'];
            $description = $_POST['description'];
            $vhc_image = $_POST['vhc_image'];
            $vhc_name = $_POST['vhc_name'];
            $disponibilite = $_POST['disponibilite'];
            $model = $_POST['model'];
            $transmition = $_POST['transmition'];
            $mileage = $_POST['mileage'];
            $prix = $_POST['prix'];

            $vehicules->modifierVeh($vehicule_id, $marque, $disponibilite, $prix, $description, $vhc_image, $mileage, $model, $transmition, $vhc_name);
        } elseif ($action === 'delete_vehicle') {
            // Delete Vehicle Logic
            $vehicule_id = $_POST['vehicule_id'];
            $vehicules->supprimerVeh($vehicule_id);
        } elseif ($action === 'accept_reservation') {
            // Accept Reservation Logic
            $rsv_id = $_POST['rsv_id'];
            $reservation->accRes($rsv_id);
        } elseif ($action === 'decline_reservation') {
            // Decline Reservation Logic
            $rsv_id = $_POST['rsv_id'];
            $reservation->decRes($rsv_id);
        } elseif ($action === 'delete_user') {
            $user_id = $_POST['user_id'];
            $user->supprimerUser($user_id);
        }
    }
}
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
                            <p class="card-text display-4"><?= $count ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Total Vehicles</h5>
                            <p class="card-text display-4"><?= $countVeh ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Active Reservations</h5>
                            <p class="card-text display-4"><?= $activeReservations ?></p>
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
                        <th>pick up place</th>
                        <th>return place</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $rsv) { ?>
                        <tr>
                            <td><?= $rsv['rsv_id'] ?></td>
                            <td><?= $rsv['user_id'] ?></td>
                            <td><?= $rsv['vehicule_id'] ?></td>
                            <td><?= $rsv['date_pickup'] ?></td>
                            <td><?= $rsv['date_return'] ?></td>
                            <td><?= $rsv['lieu_pickup'] ?></td>
                            <td><?= $rsv['lieu_return'] ?></td>

                            <td>
                                <!-- <button class="btn btn-sm btn-success">Accept</button>
                                <button class="btn btn-sm btn-danger">Decline</button> -->
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="accept_reservation">
                                    <input type="hidden" name="rsv_id" value="<?= $rsv['rsv_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-success">Accept</button>
                                </form>

                                <!-- Decline Reservation Form -->
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="decline_reservation">
                                    <input type="hidden" name="rsv_id" value="<?= $rsv['rsv_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Decline</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
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
                        <th>Marque</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Vehicule Image</th>
                        <th>Disponibilite</th>
                        <th>Mileage</th>
                        <th>Transmission</th>
                        <th>Price per Day</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($affvehicules as $vhc): ?>
                        <tr>
                            <td><?= $vhc['vehicule_id'] ?></td>
                            <td><?= $vhc['marque'] ?></td>
                            <td><?= $vhc['vhc_name'] ?></td>
                            <td><?= $vhc['model'] ?></td>
                            <td><?= strlen($vhc['vhc_image']) > 7 ? substr($vhc['vhc_image'], 9, 14) . "..." : $vhc['vhc_image'] ?></td>
                            <td>
                                <?= $vhc['disponibilite'] == 1 ? "Available" : "Not Available" ?>
                            </td>
                            <td><?= $vhc['mileage'] ?>Km</td>
                            <td><?= $vhc['transmition'] ?></td>
                            <td>$<?= $vhc['prix'] ?></td>
                            <td><?= strlen($vhc['description']) > 5 ? substr($vhc['description'], 0, 5) . "..." : $vhc['description'] ?></td>
                            <td class="d-flex gap-2">
                                <!-- Edit Button with JavaScript -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editVehicleModal">
                                    Edit
                                </button>
                                <!-- Delete Button -->
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_vehicle">
                                    <input type="hidden" name="vehicule_id" value="<?= $vhc['vehicule_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user) { ?>
                        <tr>
                            <td><?= $user['user_id'] ?></td>
                            <td><?= $user['user_name'] . " " . $user['user_last'] ?></td>
                            <td><?= $user['user_email'] ?></td>
                            <td>
                                <form method="POST" action="">
                                    <input type="hidden" name="action" value="delete_user">
                                    <input type="hidden" name="user_id" value="<?= $user['user_id'] ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
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
                    <form id="addVehicleForm" method="POST" action="">
                        <input type="hidden" name="action" value="add_vehicle">
                        <div class="mb-3">
                            <label for="vehicleMarque" class="form-label">Marque</label>
                            <input type="text" class="form-control" id="vehicleMake" name="marque">
                            <div class="error-message" id="vehicleMakeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleMake" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editVehicleName" name="vhc_name">
                            <div class="error-message" id="editVehicleMakeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleModel" class="form-label">Model</label>
                            <input type="number" class="form-control" id="vehicleModelInput" name="model">
                            <div class="error-message" id="vehicleYearError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleImg" class="form-label">Vehicle Image</label>
                            <input type="url" class="form-control" id="vehicleImage" name="vhc_image" placeholder="https://www.example.com">
                            <div class="error-message" id="vehicleImageError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleDisponibilite" class="form-label">Disponibilite</label>
                            <input type="number" min="0" max="1" class="form-control" id="vehicleDisponibilite" name="disponibilite">
                            <div class="error-message" id="vehicleDispError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleMileage" class="form-label">Mileage</label>
                            <input type="number" class="form-control" id="vehicleMileage" name="mileage">
                            <div class="error-message" id="vehicleMileageError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleTransmission" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="vehicleTransmission" name="transmition">
                            <div class="error-message" id="vehicleTransError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehiclePrice" class="form-label">Price per Day</label>
                            <input type="number" class="form-control" id="vehiclePrice" name="prix">
                            <div class="error-message" id="vehiclePriceError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="vehicleDescription" class="form-label">Description</label>
                            <input type="text" class="form-control" id="vehicleDescription" name="description">
                            <div class="error-message" id="vehicleDesError"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Vehicle</button>
                        </div>
                    </form>
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
                    <form id="editVehicleForm" method="POST">
                        <input type="hidden" name="action" value="edit_vehicle">
                        <input type="hidden" id="editVehicleIdInput" name="vehicule_id">

                        <div class="mb-3">
                            <label for="editVehicleMakeInput" class="form-label">Marque</label>
                            <input type="text" class="form-control" id="editVehicleMakeInput" name="marque">
                            <div class="error-message" id="editVehicleMakeError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleNameInput" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editVehicleNameInput" name="vhc_name">
                            <div class="error-message" id="editVehicleNameError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleModelInput" class="form-label">Model</label>
                            <input type="number" class="form-control" id="editVehicleModelInput" name="model">
                            <div class="error-message" id="editVehicleModelError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleImgInput" class="form-label">Vehicle Image</label>
                            <input type="url" class="form-control" id="editVehicleImgInput" name="vhc_image" placeholder="https://www.example.com">
                            <div class="error-message" id="editVehicleImgError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleDisponibiliteInput" class="form-label">Disponibilité</label>
                            <input type="number" min="0" max="1" class="form-control" id="editVehicleDisponibiliteInput" name="disponibilite">
                            <div class="error-message" id="editVehicleDisponibiliteError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleMileageInput" class="form-label">Mileage</label>
                            <input type="number" class="form-control" id="editVehicleMileageInput" name="mileage">
                            <div class="error-message" id="editVehicleMileageError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleTransmissionInput" class="form-label">Transmission</label>
                            <input type="text" class="form-control" id="editVehicleTransmissionInput" name="transmition">
                            <div class="error-message" id="editVehicleTransmissionError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehiclePriceInput" class="form-label">Price per Day</label>
                            <input type="number" class="form-control" id="editVehiclePriceInput" name="prix">
                            <div class="error-message" id="editVehiclePriceError"></div>
                        </div>
                        <div class="mb-3">
                            <label for="editVehicleDescriptionInput" class="form-label">Description</label>
                            <input type="text" class="form-control" id="editVehicleDescriptionInput" name="description">
                            <div class="error-message" id="editVehicleDescriptionError"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="editVehicleButton">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/validation.js"></script>
</body>

</html>