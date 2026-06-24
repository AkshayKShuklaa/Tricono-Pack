<!-- ── HERO ── -->
<?php include 'header.php';
include 'includes/db.php'; ?>
<section class="hero">
    <div class="container-pro">
        <div class="hero-content">
            <h1 data-aos="fade-right">
                Reliable &amp; Sustainable <span>Paper Packaging</span> Solutions
            </h1>
            <p data-aos="fade-up">
                Delivering high-quality industrial and commercial Paper packaging with innovation, durability and sustainable manufacturing practices.
            </p>
            <div class="hero-btns" data-aos="zoom-in">
                <a href="contact.php" class="btn-main">Get a Quote &nbsp;→</a>
                <a href="products.php" class="btn-outline">Explore Products</a>
            </div>
        </div>
    </div>
    <div class="hero-scroll"><i class="fas fa-chevron-down"></i></div>
</section>

<!-- ── STATS ── -->
<section class="stats">
    <div class="container-pro">
        <div class="stats-grid">

            <div class="stat" data-aos="fade-up">
                <h2 class="counter" data-target="12">0</h2>
                <span>+</span>
                <p>Years of Excellence</p>
            </div>

            <div class="stat" data-aos="fade-up" data-aos-delay="80">
                <h2 class="counter" data-target="500">0</h2>
                <span>+</span>
                <p>B2B Clients</p>
            </div>

            <div class="stat" data-aos="fade-up" data-aos-delay="160">
                <h2 class="counter" data-target="50">0</h2>
                <span>M+</span>
                <p>Units Produced / Year</p>
            </div>

            <div class="stat" data-aos="fade-up" data-aos-delay="240">
                <h2 class="counter" data-target="25">0</h2>
                <span>+</span>
                <p>Countries Served</p>
            </div>

        </div>
    </div>
</section>

<!-- ── ABOUT ── -->
<section class="section">
    <div class="container-pro">
        <div class="about-grid">

            <div data-aos="fade-right">
                <p class="subtitle">About Us</p>
                <h2 class="section-title">
                    Eco-Friendly Paper Packaging Solutions
                </h2>
                <p class="section-text">
                    At Tricono Pack, we manufacture premium paper bags using fully automatic machines, ensuring superior quality, consistency, and eco-friendly packaging solutions for businesses across various industries.
                </p>
                <div style="margin-top:40px">
                    <a href="about.php" class="btn-main">Read More &nbsp;→</a>
                </div>
            </div>

            <div class="about-image" data-aos="fade-left">
                <img src="https://images.unsplash.com/photo-1581093806997-124204d9fa9d?q=80&w=1600&auto=format&fit=crop" alt="Tricono Pack Manufacturing">
            </div>

        </div>
    </div>
</section>

<!-- ── PRODUCTS ── -->
<section class="section" style="background:var(--off-white); padding-top:80px; padding-bottom:80px;">
    <div class="container-pro">
        <div style="text-align:center" data-aos="fade-up">
            <p class="subtitle">Our Products</p>
            <h2 class="section-title">Packaging built for every industry</h2>
            <p style="font-size:16px;color:var(--text-body);margin-top:8px">Explore our complete range of paper and flexible packaging solutions.</p>
        </div>


        <div class="products-grid">

            <?php

            $productQuery = mysqli_query($conn, "

SELECT
    p.*,
    pc.name AS category_name

FROM products p

LEFT JOIN product_categories pc
ON pc.id = p.category_id

WHERE p.status='Active'

ORDER BY FIELD(p.slug, 'square-bottom-bags-with-twisted-handles', 'square-bottom-bags-with-flat-handles', 'd-cut-square-bottom-bags', 'square-bottom-sos-bags', 'customized-bags', 'food-grade-tray-liners-food-wrapping-papers-butter-papers') ASC

LIMIT 6

");

            while ($product = mysqli_fetch_assoc($productQuery)) {

            ?>

                <div
                    class="product-card"
                    data-aos="fade-up">

                    <div style="position:relative">

                        <img
                            src="<?php echo !empty($product['home_image']) ? 'assets/uploads/products/'.$product['home_image'] : 'assets/logo/logo.png'; ?>"
                            alt="<?php echo $product['name']; ?>">

                        <span
                            class="cat-badge"
                            style="
            position:absolute;
            top:14px;
            left:14px;
            ">

                            <?php echo $product['category_name']; ?>

                        </span>

                    </div>

                    <div class="product-content">

                        <h3>

                            <?php echo $product['home_name']; ?>

                        </h3>

                        <p>

                            <?php echo $product['home_desc']; ?>

                        </p>

                        <a
                            href="product-details.php?slug=<?php echo $product['slug']; ?>"
                            class="product-link">

                            View Details &nbsp;→

                        </a>

                    </div>

                </div>

            <?php } ?>

        </div>


    </div>
</section>

<!-- ── WHY CHOOSE ── -->
<section class="section">
    <div class="container-pro">
        <div style="text-align:center" data-aos="fade-up">
            <p class="subtitle">Why Choose Us</p>
            <h2 class="section-title">The Tricono Pack advantage</h2>
        </div>

        <div class="advantages-grid">

            <div class="adv-card" data-aos="fade-up">
                <div class="adv-icon"><i class="fas fa-shield-halved"></i></div>
                <h3>Premium Quality</h3>
                <p>ISO-grade quality control at every production stage.</p>
            </div>

            <div class="adv-card" data-aos="fade-up" data-aos-delay="80">
                <div class="adv-icon"><i class="fas fa-leaf"></i></div>
                <h3>Eco-Conscious Manufacturing</h3>
                <p>Recyclable materials and energy-efficient processes.</p>
            </div>

            <div class="adv-card" data-aos="fade-up" data-aos-delay="160">
                <div class="adv-icon"><i class="fas fa-industry"></i></div>
                <h3>Bulk Production Capacity</h3>
                <p>Millions of units per month, on schedule.</p>
            </div>

            <div class="adv-card" data-aos="fade-up" data-aos-delay="0">
                <div class="adv-icon"><i class="fas fa-print"></i></div>
                <h3>Custom Printing</h3>
                <p>Up to 8-color flexographic and rotogravure printing.</p>
            </div>

            <div class="adv-card" data-aos="fade-up" data-aos-delay="80">
                <div class="adv-icon"><i class="fas fa-truck"></i></div>
                <h3>Timely Delivery</h3>
                <p>Pan-India and international logistics network.</p>
            </div>

            <div class="adv-card" data-aos="fade-up" data-aos-delay="160">
                <div class="adv-icon"><i class="fas fa-tag"></i></div>
                <h3>Competitive Pricing</h3>
                <p>Direct from manufacturer — no middlemen markups.</p>
            </div>

        </div>
    </div>
</section>

<!-- ── INDUSTRIES ── -->
<section class="section dark-section">
    <div class="container-pro">
        <div style="text-align:center" data-aos="fade-up">
            <p class="subtitle">Industries</p>
            <h2 class="section-title dark-title">Industries We Serve</h2>
            <p class="dark-section-sub">Trusted across sectors that demand reliability and scale.</p>
        </div>

        <div class="industry-grid">
            <div class="industry-card" data-aos="fade-up">
                <div class="industry-image">
                    <img src="assets/images/ind-retail.png" alt="Retail">
                </div>
                <div class="industry-name">Retail</div>
            </div>
            <div class="industry-card" data-aos="fade-up" data-aos-delay="60">
                <div class="industry-image">
                    <img src="assets/images/ind-fmcg.png" alt="FMCG">
                </div>
                <div class="industry-name">FMCG</div>
            </div>
            <div class="industry-card" data-aos="fade-up" data-aos-delay="120">
                <div class="industry-image">
                    <img src="assets/images/ind-food.png" alt="Food Industry">
                </div>
                <div class="industry-name">Food Industry</div>
            </div>
            <div class="industry-card" data-aos="fade-up" data-aos-delay="180">
                <div class="industry-image">
                    <img src="assets/images/ind-supermarket.png" alt="Supermarkets">
                </div>
                <div class="industry-name">Supermarkets</div>
            </div>
            <div class="industry-card" data-aos="fade-up" data-aos-delay="240">
                <div class="industry-image">
                    <img src="assets/images/ind-ecommerce.png" alt="E-Commerce">
                </div>
                <div class="industry-name">E-Commerce</div>
            </div>
            <div class="industry-card" data-aos="fade-up" data-aos-delay="300">
                <div class="industry-image">
                    <img src="assets/images/ind-industrial.png" alt="Industrial">
                </div>
                <div class="industry-name">Industrial</div>
            </div>
        </div>
    </div>
</section>


<?php include 'footer.php'; ?>