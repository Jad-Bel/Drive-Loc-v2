<?php
require_once "../../../models/reservation.php";
require_once "../../../models/user.php";
require_once "../../../models/vehicule.php";
require_once "../../../includes/session_check.php";


$reservation = new reservation();
$vehiculObj = new vehicule();


$vehicule_id = isset($_GET['vehicule_id']) ? $_GET['vehicule_id'] : null;
// $vehicule_price = isset($_GET['prix']) ? $_GET['prix'] : null;
$vehiculeDetails = null;
try {
    $vehiculeDetails = $vehiculObj->getVehiculeById($vehicule_id);
    if (!$vehiculeDetails) {
        throw new Error("vehicule not found");
    }
} catch (Exception $e) {
    throw new Exception($e->getMessage());
}
var_dump($vehicule_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $date_rsv = date('Y-m-d');
        
        $user_id = $_SESSION['user_id'];
        var_dump($user_id);
        // $user_id = 9;
        $vehicule_id = $_POST['vehicule_id'];
        $date_pickup = $_POST['date_pickup'];
        $date_return = $_POST['date_return'];
        $lieu_pickup = $_POST['lieu_pickup'];
        $lieu_return = $_POST['lieu_return'];
        $vehicule_price = $_POST['prix'];


        if (strtotime($date_pickup) > strtotime($date_return)) {
            throw new Exception("Return date must be after pickup date");
        }

        if (strtotime($date_pickup) < strtotime('today')) {
            throw new Exception("Puckup date cannot be in the past");
        }

        $reservation->bookRes(
            $user_id,
            $vehicule_id,
            $date_rsv,
            $date_pickup,
            $date_return,
            $lieu_pickup,
            $lieu_return,
            $vehicule_price
        );

        $success_message = "Reservation booked successfully";
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
// var_dump($_GET['prix']); 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Driver Location</title>
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
        <h1 class="display-3 text-uppercase text-white mb-3">Car Booking</h1>
        <div class="d-inline-flex text-white">
            <h6 class="text-uppercase m-0"><a class="text-white" href="../../layouts/main.php">Home</a></h6>
            <h6 class="text-body m-0 px-3">/</h6>
            <h6 class="text-uppercase text-body m-0">Car Booking</h6>
        </div>
    </div>
    <!-- Page Header Start -->


    <!-- Detail Start -->
    <div class="container-fluid pt-5">
        <div class="container pt-5 pb-3">
        <?php if ($vehiculeDetails): ?>
            <h1 class="display-4 text-uppercase mb-5">
                <?php echo htmlspecialchars($vehiculeDetails['marque'] . ' ' . $vehiculeDetails['vhc_name']); ?>
            </h1>
            <div class="row align-items-center pb-2">
                <div class="col-lg-6 mb-4">
                    <img class="img-fluid" src="<?php echo htmlspecialchars($vehiculeDetails['vhc_image']); ?>.png" alt="<?php echo htmlspecialchars($vehiculeDetails['marque']); ?>">
                </div>
                <div class="col-lg-6 mb-4">
                    <h4 class="mb-2">$<?php echo number_format($vehiculeDetails['prix']); ?>/Day</h4>
                    <!-- Keep rating section -->
                    <div class="d-flex mb-3">
                        <h6 class="mr-2">Rating:</h6>
                        <div class="d-flex align-items-center justify-content-center mb-1">
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star text-primary mr-1"></small>
                            <small class="fa fa-star-half-alt text-primary mr-1"></small>
                            <small>(250)</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-n3 mt-lg-0 pb-4">
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-car text-primary mr-2"></i>
                    <span>Model: <?php echo htmlspecialchars($vehiculeDetails['model']); ?></span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-cogs text-primary mr-2"></i>
                    <span><?php echo htmlspecialchars($vehiculeDetails['transmition']); ?></span>
                </div>
                <div class="col-md-3 col-6 mb-2">
                    <i class="fa fa-road text-primary mr-2"></i>
                    <span><?php echo htmlspecialchars($vehiculeDetails['mileage']); ?>K</span>
                </div>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">Vehicle not found or invalid vehicle ID.</div>
        <?php endif; ?>
        </div>
    </div>
    <!-- Detail End -->


    <!-- Car Booking Start -->
    <div class="container-fluid pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h2 class="mb-4">Booking Detail</h2>
                <div class="mb-5">
                    <?php if (isset($success_message)): ?>
                        <div class="alert alert-success"><?php echo $success_message; ?></div>
                    <?php endif; ?>

                    <?php if (isset($error_message)): ?>
                        <div class="alert alert-danger"><?php echo $error_message; ?></div>
                    <?php endif; ?>
                    
                    <form method="post" action="">
                    <input type="hidden" name="price" value="<?php echo isset($_GET['prix']) ? htmlspecialchars($_GET['prix']) : ''; ?>" />
                        <!-- Hidden input for vehicule_id from URL parameter -->
                        <input type="hidden" name="vehicule_id" value="<?php echo isset($_GET['vehicule_id']) ? htmlspecialchars($_GET['vehicule_id']) : ''; ?>">
                        
                        <div class="row">
                            <div class="col-6 form-group">
                            <label for="pickup location">Pickup location</label>
                                <select class="custom-select px-4" style="height: 50px;" name="lieu_pickup" required>
                                    <option value="">Select Pickup Location</option>
                                    <option value="Casablanca">Casablanca</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Marrakech">Marrakech</option>
                                    <option value="Agadir">Agadir</option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                            <label for="return location">Return location</label>
                                <select class="custom-select px-4" style="height: 50px;" name="lieu_return" required>
                                    <option value="">Select Return Location</option>
                                    <option value="Casablanca">Casablanca</option>
                                    <option value="Rabat">Rabat</option>
                                    <option value="Marrakech">Marrakech</option>
                                    <option value="Agadir">Agadir</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-group">
                                <div class="date" id="date2" data-target-input="nearest">
                                    <label for="pickup date">Pickup Date</label>
                                    <input type="date" class="form-control p-4" 
                                           name="date_pickup" required
                                           min="<?php echo date('Y-m-d'); ?>"
                                           placeholder="Pickup Date">
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="date" id="date3" data-target-input="nearest">
                                    <label for="return date">Return Date</label>
                                    <input type="date" class="form-control p-4" 
                                           name="date_return" required
                                           min="<?php echo date('Y-m-d'); ?>"
                                           placeholder="Return Date">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Payment Section -->
                        <div class="bg-secondary p-5 mb-5">
                            <h2 class="text-primary mb-4">Payment Method</h2>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="paypal" value="paypal" required>
                                    <label class="custom-control-label" for="paypal">Paypal</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="directcheck" value="directcheck">
                                    <label class="custom-control-label" for="directcheck">Direct Check</label>
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer" value="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary py-3">Reserve Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Car Booking End -->

    <!-- Footer Start -->
    <div class="container-fluid bg-secondary py-5 px-sm-3 px-md-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="text-uppercase text-light mb-4">Get In Touch</h4>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-white mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-white mr-3"></i>+212 6933 05050</p>
                <p><i class="fa fa-envelope text-white mr-3"></i>jadthegamer06@gmail.com</p>
                <h6 class="text-uppercase text-white py-2">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://github.com/Jad-Bel"><i class="fab fa-github"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://www.linkedin.com/in/jad-belassiria-16390321b/"><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square mr-2" href="https://www.facebook.com/profile.php?id=100070651475648"><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-lg btn-dark btn-lg-square" href="https://www.instagram.com/_69eei/"><i class="fab fa-instagram"></i></a>
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
                        <a href=""><img class="w-100" src="../../img/gallery-1.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../img/gallery-2.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../img/gallery-3.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../img/gallery-4.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../img/gallery-5.jpg" alt=""></a>
                    </div>
                    <div class="col-4 px-1 mb-2">
                        <a href=""><img class="w-100" src="../../img/gallery-6.jpg" alt=""></a>
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
        <p class="mb-2 text-center text-body">&copy; <a href="#">Drive-Loc</a>. All Rights Reserved.</p>
		
		<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->					
        <p class="m-0 text-center text-body">Designed by <a href="https://htmlcodex.com">HTML Codex</a></p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../../js/main.js"></script>
</body>

</html>