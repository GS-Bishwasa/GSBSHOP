<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">GSB SHOP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item me-4">
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php
                        $cat_data_sql = $db->query("SELECT * FROM category");
                        while ($cat_data = $cat_data_sql->fetch_array()) {
                            echo '<li class="nav-item me-4">
                    <a class="nav-link dropdwon-item" href="http://localhost/GSBSHOP/category/' . $cat_data['category_url'] . '">' . htmlspecialchars($cat_data['category_name']) . '</a>
                  </li>';
                        }
                        ?>
                    </ul>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item me-4">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>

                <?php
                if (empty($_COOKIE['_aut_ui'])) {
                    echo '
    <li class="nav-item me-4">
        <a class="nav-link" href="login.php">Login</a>
    </li>
    <li class="nav-item me-4">
        <a class="nav-link" href="register.php">Register</a>
    </li>';
                } else {
                    echo '
    <li class="nav-item me-4">
        <a class="nav-link" href="my_order.php">My Order</a>
    </li>
    <li class="nav-item me-4">
        <a class="nav-link" href="signout.php">Sign Out</a>
    </li>';
                }
                ?>


            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>

    </div>
</nav>