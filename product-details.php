<?php

include 'includes/db.php';
include 'header.php';

/* =========================
CHECK SLUG
========================= */

if (!isset($_GET['slug'])) {

    header("Location: products.php");
    exit;
}

$slug = mysqli_real_escape_string(
    $conn,
    $_GET['slug']
);

/* =========================
FETCH PRODUCT
========================= */

$query = mysqli_query($conn, "
SELECT
    p.*,
    pc.name AS category_name

FROM products p

LEFT JOIN product_categories pc
ON pc.id = p.category_id

WHERE p.slug='$slug'
AND p.status='active'

LIMIT 1
");

if (mysqli_num_rows($query) == 0) {

    header("Location: products.php");
    exit;
}

$product = mysqli_fetch_assoc($query);

?>

<!-- PAGE HERO -->
<section class="page-hero">

    <div class="container-pro">

        <div class="breadcrumb">

            <a href="index.php">Home</a>

            <span>/</span>

            <a href="products.php">Products</a>

            <span>/</span>

            <span>
                <?php echo $product['name']; ?>
            </span>

        </div>

        <h1 data-aos="fade-right">

            <?php echo $product['name']; ?>

        </h1>

        <p data-aos="fade-up">

            <?php echo $product['short_description']; ?>

        </p>

    </div>

</section>

<!-- PRODUCT DETAILS -->
<section class="section">

    <div class="container-pro">

        <div class="product-details-grid">

            <!-- IMAGE -->
            <div class="product-details-image" data-aos="fade-right">

                <img
                    src="assets/uploads/products/<?php echo $product['image']; ?>"
                    alt="<?php echo $product['name']; ?>">

            </div>

            <!-- CONTENT -->
            <div class="product-details-content" data-aos="fade-left">

                <span class="details-badge">

                    <?php echo $product['category_name']; ?>

                </span>

                <h2>

                    <?php echo $product['name']; ?>

                </h2>

                <p class="details-desc">

                    <?php echo $product['description']; ?>

                </p>

                <!-- FEATURES -->
                <div class="details-block">

                    <h4>Key Features</h4>

                    <ul class="details-features">

                        <?php

                        $features =
                            explode(",", $product['features']);

                        foreach ($features as $feature) {

                        ?>

                            <li>

                                <i class="fas fa-check-circle"></i>

                                <?php echo trim($feature); ?>

                            </li>

                        <?php } ?>

                    </ul>

                </div>

                <!-- SPECS -->
                <div class="details-specs">

                    <div class="details-spec">

                        <h5>Material</h5>

                        <p>

                            <?php echo $product['material']; ?>

                        </p>

                    </div>

                    <div class="details-spec">

                        <h5>Sizes</h5>

                        <p>

                            <?php echo $product['sizes']; ?>

                        </p>

                    </div>

                </div>

                <!-- BUTTON -->
                <a href="contact.php" class="btn-main">

                    Request Quote →

                </a>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php'; ?>