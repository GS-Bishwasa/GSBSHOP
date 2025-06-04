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

</head>

<body>
  <?php
  require("element/nav.php");

  $pro_id = $_GET['p_id'];
  $pro_sql = $db->query("SELECT * FROM product WHERE id='$pro_id'");
  $aa = $pro_sql->fetch_assoc();

  $user_email = base64_decode($_COOKIE['_aut_ui']);

  $user_response = $db->query("SELECT * FROM register WHERE email = '$user_email'");
  $user_aa = $user_response->fetch_assoc();
  ?>

  <h1 class="mt-5 text-center fw-bold">Order Details</h1>

  <div class="container my-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow-lg rounded-4 p-4">
          <!-- Product Info -->
          <div class="d-flex flex-md-row flex-column align-items-center gap-4 mb-4">
            <img src="product_pic/<?php echo $aa['product_pic'] ?>" alt="Product Image" class="img-fluid rounded"
              style="max-width: 150px;">
            <div>
              <h4 class="fw-bold mb-2"><?php echo $aa['product_name'] ?></h4>
              <h5 class="text-success">&#8377; <?php echo $aa['product_amount'] ?></h5>
            </div>
          </div>

          <hr>

          <!-- Customer Details -->
          <h4 class="mb-3">Customer Details</h4>
          <table class="table table-bordered table-hover">
            <tbody>
              <tr>
                <th scope="row">Name</th>
                <td><?php echo $user_aa['fullname']; ?></td>
              </tr>
              <tr>
                <th scope="row">Phone No.</th>
                <td><?php echo $user_aa['mobile']; ?></td>
              </tr>
              <tr>
                <th scope="row">Email ID</th>
                <td><?php echo $user_aa['email']; ?></td>
              </tr>
              <tr>
                <th scope="row">Address</th>
                <td><?php echo $user_aa['address']; ?></td>
              </tr>
            </tbody>
          </table>

          <!-- Order Form -->
          <form class="order_frm">
            <div class="mb-3">
              <label for="productQty" class="form-label">Product Quantity</label>
              <input type="number" class="form-control product_qty" id="productQty" min="1" value="1" required>
            </div>



            <div class="mb-3">
              <label class="form-label">Payment Method</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="paymentOnline" required
                  value="online">
                <label class="form-check-label" for="paymentOnline">
                  Online Payment (UPI)
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="payment_mode" id="paymentCOD" value="cod">
                <label class="form-check-label" for="paymentCOD">
                  Cash On Delivery (COD)
                </label>
              </div>
            </div>

            <hr>

            <div class="text-end">
              <button type="submit" class="btn btn-primary px-4">Order Now</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>


<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
  $(".order_frm").on("submit", function (e) {
    e.preventDefault();

    const payment_mode = $("[name='payment_mode']:checked").val();
    const product_qty = $(".product_qty").val();
    const product_id = "<?php echo $pro_id; ?>";
    const product_name = "<?php echo $aa['product_name']; ?>";
    const product_amount = "<?php echo $aa['product_amount']; ?>";
    const customer_name = "<?php echo $user_aa['fullname']; ?>";
    const customer_email = "<?php echo $user_aa['email']; ?>";
    const customer_mobile = "<?php echo $user_aa['mobile']; ?>";

    if (!payment_mode) {
      alert("Please select a payment method.");
      return;
    }

    if (payment_mode === "cod") {
      window.location.href = "php/receive_order.php?p_id=" + product_id + "&p_qty=" + product_qty + "&p_mode=cod";
      return;
    }

    // Razorpay Online Payment
    const totalAmount = product_qty * product_amount * 100; // amount in paise

    const options = {
      key: "rzp_test_vQTsJ9x94i71i7", // Replace with your Razorpay Test/Live Key
      amount: totalAmount.toString(),
      currency: "INR",
      name: product_name,
      description: "Order Payment",
      image: "https://yourdomain.com/logo.png", // optional logo
      handler: function (response) {
        // On successful payment
        const payment_id = response.razorpay_payment_id;
        window.location.href =
          "php/receive_order.php?p_id=" +
          product_id +
          "&p_qty=" +
          product_qty +
          "&p_mode=online" +
          "&payment_id=" +
          payment_id;
      },
      prefill: {
        name: customer_name,
        email: customer_email,
        contact: customer_mobile,
      },
      theme: {
        color: "#0d6efd",
      },
    };

    const rzp1 = new Razorpay(options);
    rzp1.open();
  });
</script>


<?php
  require("element/footer.php");
  ?>

</body>

</html>