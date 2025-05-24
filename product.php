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

<style>
    .category-section h2 {
      position: relative;
      display: inline-block;
      padding-bottom: 8px;
      margin-bottom: 2rem;
      font-weight: 700;
      font-size: 2.5rem;
      color: #2c3e50;
    }

    .category-section h2::after {
      content: "";
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 4px;
      background: #007bff;
      border-radius: 2px;
    }

    .card {
      border-radius: 12px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }

    .card:hover {
      transform: translateY(-10px);
      box-shadow: 0 12px 25px rgba(0, 123, 255, 0.3);
    }

    .card-img-top {
      transition: transform 0.4s ease;
    }

    .card:hover .card-img-top {
      transform: scale(1.1);
    }

    .card-body {
      background-color: #f9fafb;
      padding: 1.2rem 1.5rem;
    }

    .card-title {
      color: #34495e;
      font-weight: 600;
      font-size: 1.25rem;
      margin-bottom: 1rem;
    }

    .price {
      font-size: 1.4rem;
      font-weight: 700;
      color: #007bff;
    }

    .btn-view {
      border-radius: 50px;
      padding: 0.4rem 1.2rem;
      font-weight: 600;
      transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-view:hover {
      background-color: #0056b3;
      color: #fff;
    }
  </style>





    <?php
    require("element/nav.php");
    ?>
    <div class="container">
    <?php
    $cat = $_GET['product_category'];

    $product_heading = str_replace("-"," ",$cat);
    $product_heading =  ucfirst($product_heading);

    $product_sql = $db->query("SELECT * FROM product WHERE category = '$cat'");

    echo '<div class="category-section mt-5 mb-5">';
    echo '<h2>' . $product_heading . '</h2>';
    echo '<div class="row g-4 justify-content-center">';

    while ($pro_data = $product_sql->fetch_array()) {
        $product_name = htmlspecialchars($pro_data['product_name']);
        $product_amount = number_format($pro_data['product_amount']);
        $product_pic = htmlspecialchars($pro_data['product_pic']);

        echo '
<div class="col-sm-6 col-md-4 col-lg-3">
    <div class="card h-100 shadow-sm">
        <a href="product_details.php?id=' . $pro_data['id'] . '">
            <img src="product_pic/' . $product_pic . '" class="card-img-top" alt="' . $product_name . '">
        </a>
        <div class="card-body">
            <h5 class="card-title">
                <a href="product_details.php?id=' . $pro_data['id'] . '" class="text-decoration-none text-dark">' . $product_name . '</a>
            </h5>
            <div class="d-flex justify-content-between align-items-center">
                <span class="price">&#8377;' . $product_amount . '</span>
                <a href="product_details.php?id=' . $pro_data['id'] . '">
                    <button class="btn btn-primary btn-view">View Details</button>
                </a>
            </div>
        </div>
    </div>
</div>';

    }

    echo '</div></div>';


    ?>
    </div>
</body>

</html>