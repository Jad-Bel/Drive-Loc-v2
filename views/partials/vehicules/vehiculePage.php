<?php
require_once "../../../config/connect.php";
require_once "../../../models/vehicule.php";

$vehicules = new vehiculeList();
$allVeh = new vehicule();

$search = isset($_GET['search']) ? $_GET['search'] : '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$vehiclesPerPage = 6;

// AJAX request handling
if (isset($_GET['ajax'])) {
    $offset = ($page - 1) * $vehiclesPerPage;
    $MulVehicules = $vehicules->getVehiclesByPage($vehiclesPerPage, $offset, $search);
    $totalVehicules = $vehicules->countVehicules($search);
    $totalPages = ceil($totalVehicules / $vehiclesPerPage);

    $response = [
        'html' => '',
        'totalPages' => $totalPages,
        'currentPage' => $page
    ];

    ob_start();
    foreach ($MulVehicules as $vehicule) {
        ?>
        <div class="col-lg-4 col-md-6 mb-2">
            <div class="rent-item mb-4">
                <img class="img-fluid mb-4" src="<?= $vehicule["vhc_image"] ?>.png" alt="<?= $vehicule["marque"] ?>">
                <h4 class="text-uppercase mb-4"><?= "(" . $vehicule["marque"] . ")" . " " . $vehicule["vhc_name"] ?></h4>
                <div class="d-flex justify-content-center mb-4">
                    <div class="px-2">
                        <i class="fa fa-car text-primary mr-1" aria-hidden="true"></i>
                        <span><?= $vehicule["model"] ?></span>
                    </div>
                    <div class="px-2 border-left border-right">
                        <i class="fa fa-cogs text-primary mr-1" aria-hidden="true"></i>
                        <span><?= $vehicule["transmition"] ?></span>
                    </div>
                    <div class="px-2">
                        <i class="fa fa-road text-primary mr-1" aria-hidden="true"></i>
                        <span><?= $vehicule["mileage"] ?>K</span>
                    </div>
                </div>
                <a class="btn btn-primary px-3" href="../reservation/create.php?vehicule_id=<?= $vehicule["vehicule_id"] ?>">
                    $<?= number_format($vehicule["prix"]) ?>/Day
                </a>
            </div>
        </div>
        <?php
    }
    $response['html'] = ob_get_clean();

    echo json_encode($response);
    exit;
}

// Regular page load
$totalVehicules = $vehicules->countVehicules($search);
$totalPages = ceil($totalVehicules / $vehiclesPerPage);
$currentPage = max(1, min($page, $totalPages));
$offset = ($currentPage - 1) * $vehiclesPerPage;

try {
    $MulVehicules = $vehicules->getVehiclesByPage($vehiclesPerPage, $offset, $search);
} catch (Exception $e) {
    $error_message = $e->getMessage();
    $MulVehicules = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DriveLoc</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Rubik&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../../css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-dark py-3 px-lg-5 d-none d-lg-block">
        <div class="row">
            <div class="col-md-6 text-center text-lg-left mb-2 mb-lg-0">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body pr-3" href=""><i class="fa fa-phone-alt mr-2"></i>+212 6933 05050</a>
                    <span class="text-body">|</span>
                    <a class="text-body px-3" href=""><i class="fa fa-envelope mr-2"></i>jadthegamer06@gmail.com</a>
                </div>
            </div>
            <div class="col-md-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-body px-3" href="https://github.com/Jad-Bel">
                        <i class="fab fa-github"></i>
                    </a>
                    <a class="text-body px-3" href="https://www.linkedin.com/in/jad-belassiria-16390321b/">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-body px-3" href="https://www.facebook.com/profile.php?id=100070651475648">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-body px-3" href="https://www.instagram.com/_69eei/">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="position-relative px-lg-5" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-secondary navbar-dark py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="text-uppercase text-primary mb-1">Royal Cars</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="../../layouts/main.php" class="nav-item nav-link">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <a href="service.html" class="nav-item nav-link">Service</a>
                        <div class="nav-item dropdown">
                            <!-- <a href="#" class="nav-link dropdown-toggle active" data-toggle="dropdown">Cars</a> -->
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="../vehicules/vehiculePage.php" class="dropdown-item">Car Listing</a>
                                <!-- <a href="#" class="dropdown-item">Car Detail</a> -->
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="team.html" class="dropdown-item">The Team</a>
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Page Header Start -->
    <div class="container-fluid page-header">
        <h1 class="display-3 text-uppercase text-white mb-3">Car Listing</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="../../layouts/main.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Listing</h6>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Rent A Car Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <h1 class="display-4 text-uppercase text-center mb-5">Find Your Car</h1>
            <div class="d-flex justify-content-center align-items-center mb-4">
                <input type="text" id="live_search" class="form-control me-2" placeholder="Search for cars..." value="<?= isset($search) ? htmlspecialchars($search) : '' ?>" style="width: 40%; margin-right: 10px;">
            </div>

            <div id="page-info" class="text-center mb-3">
                Showing page <?= $currentPage ?> of <?= $totalPages ?> results
            </div>
            <div id="vehicle-listings" class="row">
                <?php foreach ($MulVehicules as $vehicule): ?>
                    <div class="col-lg-4 col-md-6 mb-2">
                        <div class="rent-item mb-4">
                            <img class="img-fluid mb-4" src="<?= $vehicule["vhc_image"] ?>.png" alt="<?= $vehicule["marque"] ?>">
                            <h4 class="text-uppercase mb-4"><?= "(" . $vehicule["marque"] . ")" . " " . $vehicule["vhc_name"] ?></h4>
                            <div class="d-flex justify-content-center mb-4">
                                <div class="px-2">
                                    <i class="fa fa-car text-primary mr-1" aria-hidden="true"></i>
                                    <span><?= $vehicule["model"] ?></span>
                                </div>
                                <div class="px-2 border-left border-right">
                                    <i class="fa fa-cogs text-primary mr-1" aria-hidden="true"></i>
                                    <span><?= $vehicule["transmition"] ?></span>
                                </div>
                                <div class="px-2">
                                    <i class="fa fa-road text-primary mr-1" aria-hidden="true"></i>
                                    <span><?= $vehicule["mileage"] ?>K</span>
                                </div>
                            </div>
                            <a class="btn btn-primary px-3" href="../reservation/create.php?vehicule_id=<?= $vehicule["vehicule_id"] ?>">
                                $<?= number_format($vehicule["prix"]) ?>/Day
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav id="pagination" aria-label="Page navigation" class="w-100 text-center mt-4">
                <ul class="pagination justify-content-center">
                    <?php if ($currentPage > 1): ?>
                        <li class="page-item"><a class="page-link" href="#" data-page="1">First</a></li>
                        <li class="page-item"><a class="page-link" href="#" data-page="<?= $currentPage - 1 ?>">Previous</a></li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $currentPage ? 'active' : '' ?>">
                            <a class="page-link" href="#" data-page="<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <li class="page-item"><a class="page-link" href="#" data-page="<?= $currentPage + 1 ?>">Next</a></li>
                        <li class="page-item"><a class="page-link" href="#" data-page="<?= $totalPages ?>">Last</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
    <!-- Rent A Car End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+012 345 67890</p>
                <p><i class="fa fa-envelope text-white mr-3"></i>info@example.com</p>
                <h6 class="text-uppercase text-white py-2">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Usefull Links</h4>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Private Policy</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Term & Conditions</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>New Member Registration</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Affiliate Programme</a>
                    <a class="text-body mb-2" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Return & Refund</a>
                    <a class="text-body" href="#"><i class="fa fa-angle-right text-white mr-2"></i>Help & FQAs</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Car Gallery</h4>
                <div class="row mx-n1">
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-1.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-2.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-3.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-4.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-5.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../../img/gallery-6.jpg" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Newsletter</h4>
                <p class="mb-4">Volup amet magna clita tempor. Tempor sea eos vero ipsum. Lorem lorem sit sed elitr sed kasd et</p>
                <div class="w-100 mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control bg-dark border-dark" style="padding: 25px;" placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary text-uppercase px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
                <i>Lorem sit sed elitr sed kasd et</i>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark py-4 px-sm-3 px-md-5">
        <p class="mb-2 text-center text-body">&copy; <a href="#">Your Site Name</a>. All Rights Reserved.</p>

        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
        <p class="m-0 text-center text-body">Designed by <a href="https://htmlcodex.com">HTML Codex</a></p>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script src="../../../../js/main.js"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        let searchTimeout;
        let currentPage = 1;

        function loadVehicles(page = 1) {
            const searchQuery = $('#live_search').val();

            if (!$('#loading').length) {
                $('#vehicle-listings').append('<div id="loading" class="col-12 text-center">Searching...</div>');
            }

            $.ajax({
                url: 'vehiculePage.php',
                type: 'GET',
                data: {
                    search: searchQuery,
                    page: page,
                    ajax: true
                },
                dataType: 'json',
                success: function(response) {
                    $('#loading').remove();

                    if (response.error) {
                        $('#vehicle-listings').html('<div class="col-12 text-center text-danger"><h4>Error: ' + response.error + '</h4></div>');
                        return;
                    }

                    $('#vehicle-listings').html(response.html);
                    updatePagination(response.currentPage, response.totalPages);
                    $('#page-info').text('Showing page ' + response.currentPage + ' of ' + response.totalPages + ' results');
                },
                error: function(xhr, status, error) {
                    $('#loading').remove();
                    console.error("Search error:", error);
                    $('#vehicle-listings').html('<div class="col-12 text-center text-danger"><h4>An error occurred while searching. Please try again.</h4></div>');
                }
            });
        }

        function updatePagination(currentPage, totalPages) {
            let paginationHtml = '<ul class="pagination justify-content-center">';

            if (currentPage > 1) {
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="1">First</a></li>';
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>';
            }

            for (let i = 1; i <= totalPages; i++) {
                paginationHtml += '<li class="page-item ' + (i === currentPage ? 'active' : '') + '">';
                paginationHtml += '<a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>';
            }

            if (currentPage < totalPages) {
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + (currentPage + 1) + '">Next</a></li>';
                paginationHtml += '<li class="page-item"><a class="page-link" href="#" data-page="' + totalPages + '">Last</a></li>';
            }

            paginationHtml += '</ul>';
            $('#pagination').html(paginationHtml);
        }

        $('#live_search').on('keyup', function(event) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                currentPage = 1;
                loadVehicles(currentPage);
            }, 300);
        });

        $(document).on('click', '#pagination .page-link', function(e) {
            e.preventDefault();
            currentPage = parseInt($(this).data('page'));
            loadVehicles(currentPage);
        });

        loadVehicles(currentPage);
    });
    </script>
</body>
</html>

