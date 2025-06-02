<?php require("../db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .box {
            box-shadow: 0px 4px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            background: #fff;
        }
        img.prod-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
        @media (max-width: 768px) {
            .ord_data_frm .form-control {
                margin-bottom: 1rem;
                width: 100% !important;
            }
            .ord_data_frm .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body class="bg-light">

<div class="container py-4">

    <!-- Filter Form -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="box p-4">
                <form class="row ord_data_frm gx-3 gy-2 align-items-center">
                    <div class="col-md-4">
                        <label class="form-label">Order Status</label>
                        <select name="ods" class="form-control">
                            <option value="pending">Pending</option>
                            <option value="delivered">Delivered</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Order Date</label>
                        <input type="date" name="o_date" class="form-control">
                    </div>
                    <div class="col-md-4 mt-4 pt-2">
                        <button class="btn btn-primary w-100" type="submit">Get Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row">
        <div class="col-12">
            <div class="box p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Order Id</th>
                                <th>Product Pic</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Customer</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Payment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- JS will populate rows here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function () {
    $(".ord_data_frm").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "php/get_order_data.php",
            data: new FormData(this),
            processData: false,
            contentType: false,
            success: function (response) {
                try {
                    let all_data = JSON.parse(response);
                    $("tbody").html(""); // Clear existing rows
                    all_data.forEach(row => {
                        $("tbody").append(`
                            <tr>
                                <td>${row.id}</td>
                                <td><img src='../product_pic/${row.p_pic}' class='prod-img'></td>
                                <td>${row.p_name}</td>
                                <td>${row.p_qty}</td>
                                <td>₹${row.p_amount}</td>
                                <td>${row.c_name}</td>
                                <td>${row.c_mobile}</td>
                                <td>${row.c_address}</td>
                                <td>${row.payment_status}</td>
                                <td>${row.order_status}</td>
                            </tr>
                        `);
                    });
                } catch (err) {
                    alert("Error parsing data.");
                    console.error(err);
                }
            },
            error: function (xhr) {
                alert("Something went wrong. Please try again.");
            }
        });
    });
});
</script>

</body>
</html>
