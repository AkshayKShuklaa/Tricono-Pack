
<?php

include 'includes/db.php';

/* =========================
FEATURED BLOG
========================= */

$featuredQuery = mysqli_query($conn, "

SELECT
    b.*,
    bc.name AS category_name

FROM blogs b

LEFT JOIN blog_categories bc
ON bc.id = b.category_id

WHERE b.is_featured='yes'
AND b.status='active'

ORDER BY b.id DESC

LIMIT 1

");

/* =========================
FALLBACK IF NO FEATURED BLOG
========================= */

$featured = mysqli_fetch_assoc($featuredQuery);

if(!$featured){

    $fallbackQuery = mysqli_query($conn, "

    SELECT
        b.*,
        bc.name AS category_name

    FROM blogs b

    LEFT JOIN blog_categories bc
    ON bc.id = b.category_id

    WHERE b.status='active'

    ORDER BY b.id DESC

    LIMIT 1

    ");

    $featured = mysqli_fetch_assoc($fallbackQuery);
}

/* =========================
BLOGS
========================= */

$blogQuery = mysqli_query($conn, "

SELECT
    b.*,
    bc.name AS category_name,
    bc.slug AS category_slug

FROM blogs b

LEFT JOIN blog_categories bc
ON bc.id = b.category_id

WHERE b.status='active'

ORDER BY b.id DESC

");

/* =========================
CATEGORIES
========================= */

$catQuery = mysqli_query($conn, "

SELECT *
FROM blog_categories

ORDER BY name ASC

");

?>

<?php include 'header.php'; ?>

<!-- PAGE HERO -->
<section class="page-hero">

    <div class="container-pro">

        <div class="breadcrumb">

            <a href="index.php">Home</a>

            <span>/</span>

            <span style="color:rgba(255,255,255,0.75)">
                Blog
            </span>

        </div>

        <h1 data-aos="fade-right">
            Insights & Resources
        </h1>

        <p data-aos="fade-up">
            Industry news, packaging trends, sustainability guides and expert tips from the Tricono Pack team.
        </p>

    </div>

</section>

<!-- FEATURED BLOG -->
<?php if($featured){ ?>

<section
class="section"
style="
padding-top:72px;
padding-bottom:0;
">

    <div class="container-pro">

        <div

        data-aos="fade-up"

        style="
        background:var(--off-white);
        border-radius:20px;
        overflow:hidden;
        display:grid;
        grid-template-columns:1.2fr 1fr;
        min-height:400px;
        box-shadow:var(--shadow-lg);
        border:1.5px solid var(--gray-light);
        ">

            <!-- IMAGE -->
            <img

            src="<?php
            echo !empty($featured['image'])
            ? 'assets/uploads/blogs/'.$featured['image']
            : 'https://placehold.co/1200x800?text=Featured+Blog';
            ?>"

            alt="<?php echo $featured['title']; ?>"

            style="
            width:100%;
            height:100%;
            object-fit:cover;
            ">

            <!-- CONTENT -->
            <div
            style="
            padding:48px 44px;
            display:flex;
            flex-direction:column;
            justify-content:center;
            ">

                <div class="bc-meta">

                    <span class="bc-cat">
                        Featured
                    </span>

                    <span class="bc-date">

                        <?php

                        echo date(
                        "M d, Y",
                        strtotime(
                        $featured['created_at']
                        ));

                        ?>

                    </span>

                </div>

                <h2
                style="
                font-size:26px;
                font-weight:800;
                color:var(--navy);
                line-height:1.3;
                margin-bottom:16px;
                ">

                    <?php echo $featured['title']; ?>

                </h2>

                <p
                style="
                font-size:15px;
                color:var(--text-body);
                line-height:1.7;
                margin-bottom:28px;
                ">

                    <?php echo $featured['short_description']; ?>

                </p>

                <a
                href="blog-details.php?slug=<?php echo $featured['slug']; ?>"
                class="btn-main"
                style="width:fit-content">

                    Read Article &nbsp;→

                </a>

            </div>

        </div>

    </div>

</section>

<?php } ?>

<!-- BLOG GRID -->
<section
class="section"
style="padding-top:72px">

    <div class="container-pro">

        <!-- TOP -->
        <div

        style="
        display:flex;
        align-items:center;
        justify-content:space-between;
        margin-bottom:0;
        "

        data-aos="fade-up">

            <div>

                <p class="subtitle">
                    Latest Articles
                </p>

                <h2 class="section-title">
                    From our knowledge hub
                </h2>

            </div>

            <!-- FILTER -->
            <div
            class="filter-bar"
            style="margin:0">

                <button
                class="filter-btn active"
                onclick="filterBlogs('all',this)">

                    All

                </button>

                <?php
                while(
                $cat =
                mysqli_fetch_assoc($catQuery)
                ){
                ?>

                <button

                class="filter-btn"

                onclick="
                filterBlogs(
                '<?php echo $cat['slug']; ?>',
                this
                )">

                    <?php echo $cat['name']; ?>

                </button>

                <?php } ?>

            </div>

        </div>

        <!-- BLOG GRID -->
        <div class="blog-grid">

            <?php
            while(
            $row =
            mysqli_fetch_assoc(
            $blogQuery
            )){
            ?>

            <div

            class="blog-card"

            data-cat="
            <?php echo $row['category_slug']; ?>
            "

            data-aos="fade-up">

                <!-- IMAGE -->
                <img

                src="<?php
                echo !empty($row['image'])
                ? 'assets/uploads/blogs/'.$row['image']
                : 'https://placehold.co/800x600?text=Blog';
                ?>"

                alt="<?php echo $row['title']; ?>">

                <!-- BODY -->
                <div class="bc-body">

                    <div class="bc-meta">

                        <span class="bc-cat">

                            <?php
                            echo $row['category_name'];
                            ?>

                        </span>

                        <span class="bc-date">

                            <?php

                            echo date(
                            "M d, Y",
                            strtotime(
                            $row['created_at']
                            ));

                            ?>

                        </span>

                    </div>

                    <h3>

                        <?php echo $row['title']; ?>

                    </h3>

                    <p>

                        <?php
                        echo $row['short_description'];
                        ?>

                    </p>

                    <a
                    href="blog-details.php?slug=<?php echo $row['slug']; ?>"
                    class="bc-read">

                        Read More →

                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

        <!-- PAGINATION -->
        <div

        style="
        display:flex;
        justify-content:center;
        gap:10px;
        margin-top:60px;
        "

        data-aos="fade-up">

            <button
            style="
            width:40px;
            height:40px;
            border-radius:8px;
            border:1.5px solid var(--gray-light);
            background:var(--navy);
            color:#fff;
            font-weight:700;
            font-family:var(--font);
            cursor:pointer;
            ">

                1

            </button>

        </div>

    </div>

</section>

<!-- NEWSLETTER -->
<section
class="section"
style="
background:var(--off-white);
padding:80px 0;
">

    <div

    class="container-pro"

    style="
    text-align:center;
    max-width:600px;
    margin:auto;
    "

    data-aos="fade-up">

        <p class="subtitle">
            Newsletter
        </p>

        <h2 class="section-title">
            Stay ahead in packaging
        </h2>

        <p
        style="
        font-size:16px;
        color:var(--text-body);
        margin-bottom:32px;
        line-height:1.7;
        ">

            Get the latest industry insights, product updates and sustainability guides delivered to your inbox monthly.

        </p>

        <div
        style="
        display:flex;
        gap:12px;
        max-width:480px;
        margin:0 auto;
        ">

            <input

            type="email"

            placeholder="Enter your email address"

            style="
            flex:1;
            padding:13px 18px;
            border:1.5px solid var(--gray-light);
            border-radius:8px;
            font-size:15px;
            font-family:var(--font);
            outline:none;
            color:var(--text-dark);
            ">

            <button
            class="btn-main"
            style="
            white-space:nowrap;
            cursor:pointer;
            border:none;
            ">

                Subscribe

            </button>

        </div>

    </div>

</section>

<!-- FILTER SCRIPT -->
<script>

function filterBlogs(category,button){

    let cards =
    document.querySelectorAll('.blog-card');

    let buttons =
    document.querySelectorAll('.filter-btn');

    buttons.forEach(btn=>{

        btn.classList.remove('active');

    });

    button.classList.add('active');

    cards.forEach(card=>{

        if(category==='all'){

            card.style.display='block';

        }else{

            if(card.dataset.cat===category){

                card.style.display='block';

            }else{

                card.style.display='none';
            }
        }
    });
}

</script>

<?php include 'footer.php'; ?>
