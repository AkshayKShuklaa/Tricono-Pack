<?php

include 'includes/db.php';
include 'header.php';

/* =========================
FETCH CATEGORIES
========================= */

$catQuery = mysqli_query($conn, "
SELECT *
FROM product_categories
ORDER BY name ASC
");

/* =========================
FETCH PRODUCTS
========================= */

$productQuery = mysqli_query($conn, "
SELECT
    p.*,
    pc.name AS category_name,
    pc.slug AS category_slug

FROM products p

LEFT JOIN product_categories pc
ON pc.id = p.category_id

WHERE p.status='active'

ORDER BY FIELD(p.slug, 'square-bottom-bags-with-twisted-handles', 'square-bottom-bags-with-flat-handles', 'd-cut-square-bottom-bags', 'square-bottom-sos-bags', 'customized-bags', 'food-grade-tray-liners-food-wrapping-papers-butter-papers') ASC
");

?>
<style>
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        flex-wrap: wrap;
        margin-bottom: 60px;
    }

    .filter-btn {
        height: 52px;
        padding: 0 28px;
        border-radius: 50px;
        border: 1.5px solid #dfe6ef;
        background: #fff;
        color: #081d4d;
        font-weight: 600;
        cursor: pointer;
        transition: .3s;
        font-size: 15px;
    }

    .filter-btn.active,
    .filter-btn:hover {
        background: #081d4d;
        color: #fff;
    }

    /* =========================
PRODUCT GRID
========================= */

    .products-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 34px;
    }

    /* =========================
PRODUCT CARD
========================= */

    .prod-detail-card {

        display: grid;

        grid-template-columns: 320px 1fr;

        background: #fff;

        border-radius: 30px;

        overflow: hidden;

        border: 1px solid #edf1f7;

        box-shadow:
            0 8px 24px rgba(0, 0, 0, .04);

        transition: .35s;

        min-height: 430px;
    }

    .prod-detail-card:hover {

        transform: translateY(-5px);

        box-shadow:
            0 20px 45px rgba(0, 0, 0, .08);
    }

    /* =========================
IMAGE
========================= */

    .product-image {
        position: relative;
        height: 100%;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .prod-detail-card:hover img {
        transform: scale(1.05);
    }

    /* =========================
CATEGORY BADGE
========================= */

    .cat-badge {
        position: absolute;
        top: 22px;
        left: 22px;

        background: #fff;

        color: #081d4d;

        height: 40px;

        padding: 0 18px;

        border-radius: 40px;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 14px;
        font-weight: 700;

        box-shadow: 0 5px 15px rgba(0, 0, 0, .08);
    }

    /* =========================
BODY
========================= */

    .pdc-body {

        padding: 34px;

        display: flex;

        flex-direction: column;

        justify-content: center;
    }

    .pdc-body h3 {
        font-size: 32px;
        line-height: 1.3;
        margin-bottom: 12px;
        color: #081d4d;
        font-weight: 500;
        letter-spacing: -1px;
    }

    .pdc-body p {
        color: #5d6475;
        font-size: 15px;
        line-height: 1.4;
        margin-bottom: 15px;
        max-width: 500px;
    }

    /* =========================
FEATURES
========================= */

    .product-features {
        list-style: none;
        padding: 0;
        margin: 0 0 32px;
    }

    .product-features li {
        display: flex;
        align-items: center;
        gap: 8px;

        margin-bottom: 10px;

        color: #081d4d;

        font-size: 16px;
        font-weight: 500;
    }

    .product-features i {
        color: #2ca24c;
        font-size: 16px;
    }

    /* =========================
SPECS BOX
========================= */

    .specs-box {
        display: flex;
        gap: 20px;

        background: #f7f9fc;

        border-radius: 22px;

        padding: 22px;

        margin-bottom: 32px;

        max-width: 500px;
    }

    .spec-item {
        flex: 1;
    }

    .spec-item h5 {
        font-size: 15px;
        margin-bottom: 8px;
        color: #081d4d;
        font-weight: 700;
    }

    .spec-item p {
        margin: 0;
        font-size: 15px;
        line-height: 1.7;
        color: #667085;
    }

    /* =========================
BUTTON
========================= */

    .btn-main {
        display: inline-flex;
        align-items: center;
        justify-content: center;

        height: 56px;

        padding: 0 30px;

        border-radius: 50px;

        background: linear-gradient(135deg, #2ca24c, #1e8e3d);

        color: #fff;

        text-decoration: none;

        font-weight: 700;

        width: max-content;

        transition: .35s;
    }

    .btn-main:hover {

        transform: translateY(-2px);

        box-shadow:
            0 12px 24px rgba(44, 162, 76, .25);
    }

    /* =========================
RESPONSIVE
========================= */

    @media(max-width:1100px) {

        .prod-detail-card {

            grid-template-columns: 1fr;
        }

        .product-image {

            height: 420px;
        }

        .pdc-body {

            padding: 35px;
        }
    }

    @media(max-width:768px) {

        .product-image {

            height: 300px;
        }

        .pdc-body h3 {

            font-size: 34px;
        }

        .specs-box {

            flex-direction: column;
        }

        .pdc-body {

            padding: 28px;
        }
    }

    @media(max-width:1200px) {

        .products-grid {

            grid-template-columns: 1fr;
        }
    }

    @media(max-width:768px) {

        .prod-detail-card {

            grid-template-columns: 1fr;
        }

        .product-image {

            height: 280px;
        }
    }
</style>

<!-- PAGE HERO -->
<section class="page-hero">

    <div class="container-pro">

        <div class="breadcrumb">
            <a href="index.php">Home</a>
            <span>/</span>
            <span>Products</span>
        </div>

        <h1 data-aos="fade-right">
            Our Product Range
        </h1>

        <p data-aos="fade-up">
            Explore our complete range of industrial and flexible packaging solutions built for performance, durability and sustainability.
        </p>

    </div>

</section>

<!-- PRODUCTS -->
<section class="section">

    <div class="container-pro">

        <!-- TOP -->
        <div class="products-top" data-aos="fade-up" style="text-align:center">

            <div>
                <p class="subtitle">
                    OUR PRODUCTS
                </p>

                <h2 class="section-title">
                    Packaging built for every industry
                </h2>
            </div>

        </div>

        <!-- FILTERS -->
        <div class="filter-bar" data-aos="fade-up">

            <button
                class="filter-btn active"
                onclick="filterProducts('all',this)">
                All
            </button>

            <?php while ($cat = mysqli_fetch_assoc($catQuery)) { ?>

                <button
                    class="filter-btn"
                    onclick="filterProducts('<?php echo $cat['slug']; ?>',this)">

                    <?php echo $cat['name']; ?>

                </button>

            <?php } ?>

        </div>

        <!-- PRODUCTS GRID -->
        <div class="products-grid" id="products-grid">

            <?php while ($row = mysqli_fetch_assoc($productQuery)) { ?>


                <div
                    class="prod-detail-card"
                    data-cat="<?php echo $row['category_slug']; ?>">

                    <!-- IMAGE -->
                    <div class="product-image">

                        <img
                            src="<?php echo !empty($row['image']) ? 'assets/uploads/products/'.$row['image'] : 'assets/logo/logo.png'; ?>"
                            alt="<?php echo $row['name']; ?>">

                        <span class="cat-badge">

                            <?php echo $row['category_name']; ?>

                        </span>

                    </div>

                    <!-- CONTENT -->
                    <div class="pdc-body">

                        <h3>

                            <?php echo $row['name']; ?>

                        </h3>

                        <p>

                            <?php echo $row['short_description']; ?>

                        </p>

                        <!-- FEATURES -->
                        <ul class="product-features">

                            <?php

                            $features =
                                explode(",", $row['features']);

                            foreach ($features as $feature) {

                            ?>

                                <li>

                                    <i class="fas fa-check"></i>

                                    <?php echo trim($feature); ?>

                                </li>

                            <?php } ?>

                        </ul>

                        <!-- SPECS -->
                        <div class="specs-box">

                            <div class="spec-item">

                                <h5>Material</h5>

                                <p>

                                    <?php echo $row['material']; ?>

                                </p>

                            </div>

                            <div class="spec-item">

                                <h5>Sizes</h5>

                                <p>

                                    <?php echo $row['sizes']; ?>

                                </p>

                            </div>

                        </div>

                        <a
                            href="product-details.php?slug=<?php echo $row['slug']; ?>"
                            class="btn-main">

                            Request Quote →

                        </a>

                    </div>

                </div>



            <?php } ?>

        </div>

    </div>

</section>

<!-- CTA -->
<section class="cta-section">

    <div class="container-pro">

        <div class="cta-box" data-aos="fade-up">

            <p class="subtitle">
                GET STARTED
            </p>

            <h2>
                Need a custom packaging solution?
            </h2>

            <p>
                Tell us your requirements and our team will create a tailored packaging solution for your business.
            </p>

            <a href="contact.php" class="btn-main">
                Request a Free Quote →
            </a>

        </div>

    </div>

</section>

<!-- FILTER SCRIPT -->
<script>
    function filterProducts(category, button) {

        let cards =
            document.querySelectorAll('.prod-detail-card');

        let buttons =
            document.querySelectorAll('.filter-btn');

        buttons.forEach(btn => {

            btn.classList.remove('active');

        });

        button.classList.add('active');

        cards.forEach(card => {

            if (category === 'all') {

                card.style.display = 'grid';

            } else {

                if (card.dataset.cat === category) {

                    card.style.display = 'grid';

                } else {

                    card.style.display = 'none';

                }
            }
        });
    }
</script>

<?php include 'footer.php'; ?>