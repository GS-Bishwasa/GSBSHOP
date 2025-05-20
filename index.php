<?php
require "php/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">GSB SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <?php
                    $cat_data_sql = $db->query("SELECT * FROM category");
                    while ($cat_data = $cat_data_sql->fetch_array()) {
                        echo ' <li class="nav-item me-4">
                        <a class="nav-link" href="#">' . $cat_data['category_name'] . '</a>
                    </li>';
                    }
                    ?>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item me-4">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Image Carousel -->
    <div id="carouselExampleFade" class="carousel slide carousel-fade ">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="images/banner1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="images/banner2.webp" class="d-block w-100" alt="...">
            </div>
            <!-- <div class="carousel-item">
      <img src="..." class="d-block w-100" alt="...">
    </div> -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container">
        <?php
        $cat_data_sql = $db->query("SELECT * FROM category");

        while ($cat_data = $cat_data_sql->fetch_array()) {
            $cat = $cat_data['category_url'];
            $cat_name = $cat_data['category_name'];
            $product_sql = $db->query("SELECT * FROM product WHERE category = '$cat'");
            echo '<div class="row">
        <h1 class="my-5 text-center">'.$cat_name.'</h1>
        ';
            while ($pro_data = $product_sql->fetch_array()) {
                echo '
    <div class= "col-md-3">
    <div class="card rounded-0">
    <img src="product_pic/' . $pro_data['product_pic'] . '" class="w-100">
<div class="card-body rounded-0" style="background-color:#e5e5e5;">
<label class="fs-6 text-dark">' . $pro_data['product_name'] . '</label><br>
<div class="d-flex justify-content-between align-items-center">
<label class="fs-5 text-dark">&#8377;' . $pro_data['product_amount'] . '</label>
<button class="btn btn-primary">View Details</button>
</div>
</div>
    </div>
    </div>
    ';
            }
        }
        echo '</div>';
        ?>

    </div>

</body>

</html>