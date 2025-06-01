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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <style>
        body {
            font-family: 'Ubuntu', sans-serif;
            background-color: #f4f6f9;
        }

        .order-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            padding: 20px;
        }

        .order-img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .badge-status {
            font-size: 0.9rem;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php require("element/nav.php"); ?>

    <h1 class="mt-5 text-center fw-bold">Order Details</h1>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php
                $user_email = base64_decode($_COOKIE['_aut_ui']);
                $get_data = $db->query("SELECT * FROM receive_order WHERE c_email = '$user_email' AND order_status = 'pending' ");

                if ($get_data->num_rows > 0) {
                    while ($row = $get_data->fetch_assoc()) {
                        echo '
                        <div class="order-card">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="product_pic/' . $row['p_pic'] . '" class="order-img" alt="Product Image">
                                </div>
                                <div class="col-md-8">
                                    <h4 class="fw-bold">' . htmlspecialchars($row['p_name']) . '</h4>
                                    <p><span class="label">Price:</span> ₹' . $row['p_amount'] . '</p>
                                    <p><span class="label">Quantity:</span> ' . $row['p_qty'] . '</p>
                                    <p><span class="label">Total:</span> ₹' . $row['tp_amount'] . '</p>
                                    <p><span class="label">Payment Mode:</span> ' . ucfirst($row['payment_mode']) . '</p>
                                    <p><span class="label">Payment Status:</span> 
                                        <span class="badge bg-' . ($row['payment_status'] == "completed" ? 'success' : 'warning') . ' badge-status">' . ucfirst($row['payment_status']) . '</span>
                                    </p>
                                    <p><span class="label">Order Date:</span> ' . $row['order_date'] . '</p>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo '<div class="alert alert-info text-center">No pending orders found.</div>';
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>
