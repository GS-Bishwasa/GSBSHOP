<?php require "php/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <!-- Optional custom styles -->
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .shadow-sm:hover {
            box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15) !important;
        }
    </style>
</head>
<body>

<?php require "element/nav.php";?>

<!-- About Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Image -->
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="aboutus.jpg" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <!-- Text Content -->
            <div class="col-md-6">
                <h2 class="mb-3">About Our Company</h2>
                <p>
                    We are a passionate team dedicated to delivering high-quality products and services.
                    Our mission is to make technology more accessible and helpful for everyone.
                </p>
                <p>
                    Founded in 2000, we’ve helped thousands of customers and are growing every day.
                    Customer satisfaction and innovation are at the core of what we do.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Mission & Vision -->
<section class="py-5">
    <div class="container text-center">
        <h3 class="mb-4">Our Mission & Vision</h3>
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white border rounded shadow-sm h-100">
                    <h5 class="text-primary">Our Mission</h5>
                    <p>
                        To empower individuals and businesses by providing reliable, affordable, and innovative digital solutions.
                    </p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="p-4 bg-white border rounded shadow-sm h-100">
                    <h5 class="text-success">Our Vision</h5>
                    <p>
                        To be a leader in the tech industry by delivering value-driven services and adapting to changing needs.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Bootstrap 5 JS Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php require 'element/footer.php'; ?>
