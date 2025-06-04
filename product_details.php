<?php
require "php/db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Product Details</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet" />

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>

  <!-- Magnifier CSS -->
  <style>
    .img-magnifier-container {
      position: relative;
    }

    .img-magnifier-glass {
      position: absolute;
      border: 3px solid #000;
      border-radius: 50%;
      cursor: none;
      /* Set the size of the magnifier glass: */
      width: 150px;
      height: 150px;
      box-shadow: 0 0 8px rgba(0,0,0,0.4);
      background-repeat: no-repeat;
      background-size: 200% 200%;
      z-index: 10;
    }
  </style>
</head>

<body>
  <?php
  require("element/nav.php");

  $pro_id = $_GET['id'];
  $pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
  $aa = $pro_sql->fetch_assoc();
  ?>

  <h1 class="mt-5 text-center fw-bold">Product Details</h1>

  <div class="container my-4">
    <div class="row align-items-center">
      <!-- Product Image with Magnifier -->
      <div class="col-md-6 text-center mb-4 mb-md-0">
        <div class="img-magnifier-container">
          <img 
            id="productImage" 
            src="product_pic/<?php echo htmlspecialchars($aa['product_pic']); ?>" 
            alt="Product Image" 
            class="img-fluid rounded shadow"
            style="max-width: 90%; object-fit: contain;" />
        </div>
      </div>

      <!-- Product Info -->
      <div class="col-md-6 p-4">
        <div class="d-flex flex-column justify-content-center h-100">

          <h2 class="fw-semibold mb-3"><?php echo htmlspecialchars($aa['product_name']); ?></h2>
          <hr />

          <h3 class="text-primary mb-3">&#8377;<?php echo htmlspecialchars($aa['product_amount']); ?></h3>

          <?php if ($aa['product_quantity'] == 0): ?>
            <h4 class="text-danger mb-3">Stock: Not Available</h4>
          <?php else: ?>
            <h4 class="text-success mb-3">Stock: Available</h4>
          <?php endif; ?>

          <label class="fs-5 fw-semibold mb-2" for="productFeature">Product Feature</label>
          <p id="productFeature" class="mb-4"><?php echo nl2br(($aa['product_description'])); ?></p>
<?php
if (!empty($_COOKIE['_aut_ui'])) {
  echo '<a href="order_details.php?p_id='.$pro_id.'"><button class="btn btn-primary w-50 align-self-start buy-btn">Buy Now</button></a>';
}else{
    echo '<a href="login.php"><button class="btn btn-primary w-50 align-self-start">Buy Now</button></a>';
}
?>
          <!-- <button class="btn btn-primary w-50 align-self-start">Buy Now</button> -->

        </div>
      </div>
    </div>
  </div>

  <script>
  function magnify(imgID, zoom) {
    var img = document.getElementById(imgID);
    var glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");

    glass.style.display = "none"; // Hide initially
    img.parentElement.insertBefore(glass, img);

    glass.style.backgroundImage = "url('" + img.src + "')";
    glass.style.backgroundRepeat = "no-repeat";
    glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";

    var bw = 3;
    var w = glass.offsetWidth / 2;
    var h = glass.offsetHeight / 2;

    function moveMagnifier(e) {
      var pos = getCursorPos(e);
      var x = pos.x;
      var y = pos.y;

      if (x > img.width - (w / zoom)) x = img.width - (w / zoom);
      if (x < w / zoom) x = w / zoom;
      if (y > img.height - (h / zoom)) y = img.height - (h / zoom);
      if (y < h / zoom) y = h / zoom;

      glass.style.left = (x - w) + "px";
      glass.style.top = (y - h) + "px";
      glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
    }

    function getCursorPos(e) {
      var a = img.getBoundingClientRect();
      var x = e.pageX - a.left - window.pageXOffset;
      var y = e.pageY - a.top - window.pageYOffset;
      return { x: x, y: y };
    }

    img.addEventListener("mouseenter", function () {
      glass.style.display = "block";
    });

    img.addEventListener("mouseleave", function () {
      glass.style.display = "none";
    });

    img.addEventListener("mousemove", moveMagnifier);
    glass.addEventListener("mousemove", moveMagnifier);

    // Optional: for touch screens
    img.addEventListener("touchstart", function () {
      glass.style.display = "block";
    });
    img.addEventListener("touchend", function () {
      glass.style.display = "none";
    });
    img.addEventListener("touchmove", moveMagnifier);
    glass.addEventListener("touchmove", moveMagnifier);
  }

  magnify("productImage", 2); // You can change the zoom level here




</script>

<?php
  require("element/footer.php");
  ?>

</body>

</html>
