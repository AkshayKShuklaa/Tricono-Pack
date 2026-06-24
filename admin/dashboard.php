<?php

include 'includes/db.php';

$pageTitle = "Dashboard";

include 'includes/header.php';

include 'includes/sidebar.php';

/* =========================
TOTAL PRODUCTS
========================= */

$productCount = mysqli_fetch_assoc(

    mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM products
    ")

);

/* =========================
TOTAL BLOGS
========================= */

$blogCount = mysqli_fetch_assoc(

    mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM blogs
    ")

);

/* =========================
TOTAL CATEGORIES
========================= */

$categoryCount = mysqli_fetch_assoc(

    mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM product_categories
    ")

);

/* =========================
TOTAL INQUIRIES
========================= */

$inquiryCount = mysqli_fetch_assoc(

    mysqli_query($conn, "
    SELECT COUNT(*) AS total
    FROM contact_inquiries
    ")

);

/* =========================
RECENT PRODUCTS
========================= */

$recentProducts = mysqli_query($conn, "

SELECT
    p.*,
    pc.name AS category_name

FROM products p

LEFT JOIN product_categories pc
ON pc.id = p.category_id

ORDER BY p.id DESC

LIMIT 5

");

/* =========================
RECENT BLOGS
========================= */

$recentBlogs = mysqli_query($conn, "

SELECT *
FROM blogs

ORDER BY id DESC

LIMIT 5

");

?>

<!-- SIDEBAR -->
<?php include 'includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
<div class="main-content">

    <!-- TOPBAR -->
    <?php include 'includes/topbar.php'; ?>

    <div class="content-wrapper">

        <!-- STATS -->
        <div class="stats-grid">

            <!-- PRODUCTS -->
            <div class="stats-card">

                <div class="stats-icon">

                    <i class="fas fa-box"></i>

                </div>

                <h3>

                    <?php echo $productCount['total']; ?>

                </h3>

                <p>Total Products</p>

            </div>

            <!-- BLOGS -->
            <div class="stats-card">

                <div class="stats-icon">

                    <i class="fas fa-blog"></i>

                </div>

                <h3>

                    <?php echo $blogCount['total']; ?>

                </h3>

                <p>Total Blogs</p>

            </div>

            <!-- CATEGORIES -->
            <div class="stats-card">

                <div class="stats-icon">

                    <i class="fas fa-layer-group"></i>

                </div>

                <h3>

                    <?php echo $categoryCount['total']; ?>

                </h3>

                <p>Product Categories</p>

            </div>

            <!-- INQUIRIES -->
            <div class="stats-card">

                <div class="stats-icon">

                    <i class="fas fa-envelope"></i>

                </div>

                <h3>

                    <?php echo $inquiryCount['total']; ?>

                </h3>

                <p>Total Inquiries</p>

            </div>

        </div>

        <!-- RECENT PRODUCTS -->
        <div class="table-card mb-4">

            <div class="table-card-header">

                <h4>
                    Recent Products
                </h4>

                <a
                    href="products/manage-products.php"
                    class="btn-main">

                    View All

                </a>

            </div>

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>Image</th>

                            <th>Name</th>

                            <th>Category</th>

                            <th>Status</th>

                            <th>Created</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        while ($row =
                            mysqli_fetch_assoc(
                                $recentProducts
                            )
                        ) {
                        ?>

                            <tr>

                                <td width="80">

                                    <img
                                        src="../assets/uploads/products/<?php echo $row['image']; ?>"
                                        style="
                                width:60px;
                                height:60px;
                                border-radius:12px;
                                object-fit:cover;
                                ">

                                </td>

                                <td>

                                    <strong>

                                        <?php echo $row['name']; ?>

                                    </strong>

                                </td>

                                <td>

                                    <?php echo $row['category_name']; ?>

                                </td>

                                <td>

                                    <?php if ($row['status'] == 'active') { ?>

                                        <span class="badge-status badge-active">

                                            Active

                                        </span>

                                    <?php } else { ?>

                                        <span class="badge-status badge-inactive">

                                            Inactive

                                        </span>

                                    <?php } ?>

                                </td>

                                <td>

                                    <?php

                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $row['created_at']
                                        )
                                    );

                                    ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- RECENT BLOGS -->
        <div class="table-card">

            <div class="table-card-header">

                <h4>
                    Recent Blogs
                </h4>

                <a
                    href="blogs/manage-blogs.php"
                    class="btn-main">

                    View All

                </a>

            </div>

            <div class="table-responsive">

                <table class="table">

                    <thead>

                        <tr>

                            <th>Image</th>

                            <th>Title</th>

                            <th>Status</th>

                            <th>Created</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        while ($blog =
                            mysqli_fetch_assoc(
                                $recentBlogs
                            )
                        ) {
                        ?>

                            <tr>

                                <td width="80">

                                    <img
                                        src="../uploads/blogs/<?php echo $blog['image']; ?>"
                                        style="
                                width:60px;
                                height:60px;
                                border-radius:12px;
                                object-fit:cover;
                                ">

                                </td>

                                <td>

                                    <strong>

                                        <?php echo $blog['title']; ?>

                                    </strong>

                                </td>

                                <td>

                                    <?php if ($blog['status'] == 'active') { ?>

                                        <span class="badge-status badge-active">

                                            Active

                                        </span>

                                    <?php } else { ?>

                                        <span class="badge-status badge-inactive">

                                            Inactive

                                        </span>

                                    <?php } ?>

                                </td>

                                <td>

                                    <?php

                                    echo date(
                                        "d M Y",
                                        strtotime(
                                            $blog['created_at']
                                        )
                                    );

                                    ?>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>