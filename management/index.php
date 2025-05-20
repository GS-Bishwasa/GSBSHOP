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


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    * {
        font-family: "Ubuntu", sans-serif;
        margin: 0;
        padding: 0;
        /* cursor: url('cursor.png'), auto; */
    }

    .main-container {
        width: 100%;
        height: 100vh;
    }

    .left {
        width: 17%;
        height: 100%;
        background-color: #080429;
    }

    .right {
        width: 83%;
        height: 100%;
        /* background-color:green; */
        overflow-y: auto;
    }
    .my_menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            cursor: pointer;
        }

        .my_menu li {
            width: 100%;
            padding: 10px;
            padding-left: 40px;
            color: white;
        }

        .my_menu li:hover {
            background-color: #fff;
            color: #080429;
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
        .menu{
            border-bottom: 1px solid #fff;
        }
</style>

<body>
    <div class="main-container d-flex">
        <div class="left">
            <div class="d-flex justify-content-center align-items-center flex-column">
                <ul class="my_menu">
                    <li class="menu" p_link="category">Category</li>
                    <li class="menu" p_link="add_products">Add Products</li>
                    <li class="menu" p_link="all_products">All Products</li>
                </ul>
            </div>
        </div>



        <div class="right">
<div class="content p-4">

</div>
        </div>
        <div class="msg d-none"></div>
    </div>
    <script>
        $(function(){
            $(".menu").each(function () {
                $(this).on("click", function () {
                    let page_link = $(this).attr("p_link")
                    // alert(page_link)
                    $.ajax({
                        type: "POST",
                        url: "php/pages/" + page_link + ".php",
                        beforeSend: function () {
                            let div = document.createElement("DIV");
                            $(div).addClass("alert alert-primary fs-1 text-center p-5");
                            $(div).html('<i class="fa-solid fa-spinner fa-spin display-1"></i><br>Loading...');
                            $(".msg").html(div);
                            $(".msg").removeClass("d-none")
                        },
                        success: function (response) {
                            $(".msg").addClass("d-none")
                            $(".content").html(response)
                        }
                    });
                });
            })
        })
    </script>
</body>

</html>