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
    <?php
    require("element/nav.php");
    ?>

    <?php
    $pro_id = $_GET['id'];
    $pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
    $aa = $pro_sql->fetch_assoc();
    ?>

    <h1 class="mt-5 text-center fw-bold">Product Details</h1>

<div class="container my-4">
  <div class="row align-items-center">
    <!-- Product Image -->
    <div class="col-md-6 text-center mb-4 mb-md-0">
      <img 
        src="product_pic/<?php echo htmlspecialchars($aa['product_pic']); ?>" 
        alt="Product Image" 
        class="img-fluid rounded shadow" 
        style="max-width: 90%; object-fit: contain;">
    </div>

    <!-- Product Info -->
    <div class="col-md-6 p-4">
      <div class="d-flex flex-column justify-content-center h-100">

        <h2 class="fw-semibold mb-3"><?php echo htmlspecialchars($aa['product_name']); ?></h2>
        <hr>

        <h3 class="text-primary mb-3">&#8377;<?php echo htmlspecialchars($aa['product_amount']); ?></h3>

        <?php if ($aa['product_quantity'] == 0): ?>
          <h4 class="text-danger mb-3">Stock: Not Available</h4>
        <?php else: ?>
          <h4 class="text-success mb-3">Stock: Available</h4>
        <?php endif; ?>

        <label class="fs-5 fw-semibold mb-2" for="productFeature">Product Feature</label>
        <p id="productFeature" class="mb-4"><?php echo ($aa['product_description']); ?></p>

        <button class="btn btn-primary w-50 align-self-start">Buy Now</button>

      </div>
    </div>
  </div>
</div>

</body>

</html>