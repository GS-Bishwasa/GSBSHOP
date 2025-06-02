<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Responsive Sidebar Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap"
        rel="stylesheet" />

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <style>
        * {
            font-family: "Ubuntu", sans-serif;
            margin: 0;
            padding: 0;
        }

        .main-container {
            width: 100%;
            height: 100vh;
            overflow: hidden;
        }

        .left {
            background-color: #080429;
            height: 100%;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            width: 250px;
            transition: transform 0.3s ease;
            z-index: 1050;
        }

        .left .close-btn {
            display: none;
        }

        .right {
            margin-left: 250px;
            height: 100vh;
            overflow-y: auto;
            transition: margin-left 0.3s ease;
        }

        .my_menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .my_menu li {
            padding: 12px 20px;
            color: white;
            cursor: pointer;
        }

        .my_menu li:hover {
            background-color: #ffffff;
            color: #080429;
        }

        .menu {
            border-bottom: 1px solid #fff;
        }

        .msg {
            height: 100vh;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 100000;
        }

        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 10px;
            left: 10px;
            z-index: 1100;
            background-color: #080429;
            color: white;
            border: none;
            padding: 10px 15px;
            font-size: 20px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .left {
                transform: translateX(-100%);
            }

            .left.active {
                transform: translateX(0);
            }

            .right {
                margin-left: 0;
            }

            .sidebar-toggle {
                display: block;
            }

            .left .close-btn {
                display: block;
                color: white;
                text-align: right;
                padding: 10px 20px;
                font-size: 24px;
                cursor: pointer;
            }

            .active-menu {
                background-color: #fff;
                color: #080429;
            }

        }
    </style>
</head>

<body>
    <!-- Toggle Button for Mobile -->
    <button class="sidebar-toggle"><i class="fas fa-bars"></i></button>

    <div class="main-container d-flex">
        <!-- Sidebar -->
        <div class="left" id="sidebar">
            <div class="close-btn">&times;</div>
            <ul class="my_menu">
                <li class="menu" p_link="category">Category</li>
                <li class="menu" p_link="add_products">Add Products</li>
                <li class="menu" p_link="all_products">All Products</li>
                <li class="menu" p_link="orders">Orders</li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="right flex-grow-1">
            <div class="content p-4">
                <!-- AJAX content will load here -->
                <h1>Welcome</h1>
            </div>
        </div>

        <!-- Loading Overlay -->
        <div class="msg d-none"></div>
    </div>

    <script>
        $(function () {
            function loadPage(page_link) {
                $.ajax({
                    type: "POST",
                    url: "php/pages/" + page_link + ".php",
                    beforeSend: function () {
                        let div = document.createElement("DIV");
                        $(div).addClass("alert alert-primary fs-1 text-center p-5");
                        $(div).html('<i class="fa-solid fa-spinner fa-spin display-1"></i><br>Loading...');
                        $(".msg").html(div);
                        $(".msg").removeClass("d-none");
                    },
                    success: function (response) {
                        $(".msg").addClass("d-none");
                        $(".content").html(response);
                        $("#sidebar").removeClass("active");
                    }
                });
            }

            // Default load "category"
            loadPage("category");
            $(".menu").removeClass("active-menu");
            $(".menu[p_link='category']").addClass("active-menu");

            // Menu item click
            $(".menu").on("click", function () {
                let page_link = $(this).attr("p_link");
                $(".menu").removeClass("active-menu");
                $(this).addClass("active-menu");
                loadPage(page_link);
            });

            // Sidebar toggle for mobile
            $(".sidebar-toggle").on("click", function () {
                $("#sidebar").toggleClass("active");
            });

            // Close button in sidebar
            $(".close-btn").on("click", function () {
                $("#sidebar").removeClass("active");
            });
        });
    </script>

</body>

</html>