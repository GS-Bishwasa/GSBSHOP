 <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary shadow sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">GSB SHOP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

       <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item me-4">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <?php
        $cat_data_sql = $db->query("SELECT * FROM category");
        while ($cat_data = $cat_data_sql->fetch_array()) {
            echo '<li class="nav-item me-4">
                    <a class="nav-link" href="product.php?product_category='.$cat_data['category_url'].'">' . htmlspecialchars($cat_data['category_name']) . '</a>
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
     <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
</div>

    </div>
</nav>