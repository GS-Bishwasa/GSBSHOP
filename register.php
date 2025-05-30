<?php require "php/db.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | MyApp</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- jQuery (Loaded before your script) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #f9f9f9;
        }

        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .register-heading {
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            font-weight: 500;
        }

        .right-panel img {
            width: 100%;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: none;
        }
    </style>
</head>

<body>

    <?php require("element/nav.php"); ?>

    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="register-container">
                    <h1 class="register-heading">Register With Us</h1>

                    <!-- 🛠️ Add method="post" and id for easier JS binding -->
                    <form class="register_frm" id="registerForm" method="post">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">Mobile No.</label>
                            <input type="tel" id="mobile" name="mobile" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email ID</label>
                            <input type="email" id="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" class="form-control address" id="address" rows="3"
                                placeholder="Enter your full address..." required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 r_btn">Register Now</button>
                        <div class="mt-3 text-success" id="successMsg"></div>
                        <div class="mt-3 text-danger" id="errorMsg"></div>
                    </form>

                </div>
            </div>

            <div class="col-md-6 d-none d-md-block right-panel">
                <!-- Optional Image -->
                <!-- <img src="https://source.unsplash.com/600x400/?team,join,people" alt="Register Illustration" /> -->
            </div>
        </div>
    </div>

    <!-- ✅ Proper AJAX Script -->
    <script>
        $(document).ready(function () {
            $("#registerForm").on("submit", function (e) {
                e.preventDefault();
                $("#successMsg").text('');
                $("#errorMsg").text('');

                $.ajax({
                    type: "POST",
                    url: "php/new_user.php",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    beforeSend: function () {
                        $(".r_btn").html("Please Wait...");
                        $(".r_btn").attr("disabled", true);
                    },
                    success: function (response) {
                        $(".r_btn").html("Register Now");
                        $(".r_btn").removeAttr("disabled");

                        if (response.trim() === "success") {
                            setTimeout(() => {
                                $("#successMsg").text("Registration successful!");
                                $("#registerForm")[0].reset();
                            }, 3000);
                        } else {
                            $("#errorMsg").text(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        $(".r_btn").html("Register Now");
                        $(".r_btn").removeAttr("disabled");
                        $("#errorMsg").text("Something went wrong: " + error);
                        console.error("AJAX Error:", status, error);
                    }
                });
            });
        });
    </script>

</body>

</html>