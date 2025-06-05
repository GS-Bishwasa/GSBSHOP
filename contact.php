<?php require "php/db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }
        .contact-section {
            background: #f8f9fa;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }
    </style>
</head>
<body>

<?php require "element/nav.php";?>

<!-- Contact Us Section -->
<section class="contact-section py-5">
    <div class="container">
        <h2 class="text-center mb-4">Contact Us</h2>
        <div class="row">
            <!-- Contact Info -->
            <div class="col-md-6 mb-4">
                <h5>Get in touch</h5>
                <p><i class="fas fa-map-marker-alt me-2 text-primary"></i> 123 Street Name, City, State</p>
                <p><i class="fas fa-phone-alt me-2 text-primary"></i> +91 98765 43210</p>
                <p><i class="fas fa-envelope me-2 text-primary"></i> contact@example.com</p>
                <p>We’d love to hear from you! Whether you have a question or just want to say hello, reach out to us.</p>
            </div>

            <!-- Contact Form -->
            <div class="col-md-6">
                <form action="php/send_message.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name*</label>
                        <input type="text" class="form-control" id="name" name="name" required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email*</label>
                        <input type="email" class="form-control" id="email" name="email" required />
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject*</label>
                        <input type="text" class="form-control" id="subject" name="subject" required />
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message*</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message <i class="fas fa-paper-plane ms-1"></i></button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<?php require 'element/footer.php'; ?>