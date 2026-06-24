
<?php

include 'includes/db.php';

/* =========================
CHECK SLUG
========================= */

if(!isset($_GET['slug'])){

    header("Location: blog.php");
    exit;
}

$slug =
mysqli_real_escape_string(
    $conn,
    $_GET['slug']
);

/* =========================
FETCH BLOG
========================= */

$query = mysqli_query($conn, "

SELECT
    b.*,
    bc.name AS category_name

FROM blogs b

LEFT JOIN blog_categories bc
ON bc.id = b.category_id

WHERE b.slug='$slug'
AND b.status='active'

LIMIT 1

");

/* =========================
BLOG NOT FOUND
========================= */

if(mysqli_num_rows($query) == 0){

    header("Location: blog.php");
    exit;
}

$blog =
mysqli_fetch_assoc($query);

/* =========================
RELATED BLOGS
========================= */

$relatedQuery = mysqli_query($conn, "

SELECT *
FROM blogs

WHERE category_id='".$blog['category_id']."'
AND id!='".$blog['id']."'
AND status='active'

ORDER BY id DESC

LIMIT 3

");

?>

<?php include 'header.php'; ?>

<!-- PAGE HERO -->
<section class="page-hero">

    <div class="container-pro">

        <!-- BREADCRUMB -->
        <div class="breadcrumb">

            <a href="index.php">
                Home
            </a>

            <span>/</span>

            <a href="blog.php">
                Blog
            </a>

            <span>/</span>

            <span
            style="
            color:rgba(255,255,255,0.75)
            ">

                <?php echo $blog['title']; ?>

            </span>

        </div>

        <!-- CATEGORY -->
        <div
        style="
        margin-bottom:18px;
        ">

            <span
            style="
            background:rgba(255,255,255,0.15);
            color:#fff;
            padding:10px 18px;
            border-radius:50px;
            font-size:13px;
            font-weight:700;
            backdrop-filter:blur(8px);
            ">

                <?php
                echo $blog['category_name'];
                ?>

            </span>

        </div>

        <!-- TITLE -->
        <h1
        style="
        max-width:900px;
        ">

            <?php echo $blog['title']; ?>

        </h1>

        <!-- META -->
        <div
        style="
        display:flex;
        gap:20px;
        margin-top:22px;
        flex-wrap:wrap;
        color:rgba(255,255,255,0.8);
        font-size:14px;
        ">

            <span>

                <i
                class="fas fa-calendar"
                style="margin-right:8px">
                </i>

                <?php

                echo date(
                "F d, Y",
                strtotime(
                $blog['created_at']
                ));

                ?>

            </span>

            <span>

                <i
                class="fas fa-folder"
                style="margin-right:8px">
                </i>

                <?php
                echo $blog['category_name'];
                ?>

            </span>

        </div>

    </div>

</section>

<!-- BLOG DETAILS -->
<section
class="section"
style="
padding-top:80px;
">

    <div
    class="container-pro"

    style="
    max-width:1100px;
    ">

        <!-- IMAGE -->
        <div
        data-aos="fade-up">

            <img

            src="<?php
            echo !empty($blog['image'])
            ? 'assets/uploads/blogs/'.$blog['image']
            : 'https://placehold.co/1200x700?text=Blog+Image';
            ?>"

            alt="<?php echo $blog['title']; ?>"

            style="
            width:100%;
            border-radius:24px;
            display:block;
            box-shadow:var(--shadow-lg);
            border:1.5px solid var(--gray-light);
            ">

        </div>

        <!-- CONTENT -->
        <div

        class="blog-content"

        data-aos="fade-up"

        style="
        margin-top:50px;
        background:#fff;
        border-radius:24px;
        padding:55px;
        box-shadow:var(--shadow-md);
        border:1.5px solid var(--gray-light);
        line-height:1.9;
        font-size:17px;
        color:var(--text-body);
        ">

            <?php echo $blog['description']; ?>

        </div>

    </div>

</section>

<!-- RELATED BLOGS -->
<?php if(mysqli_num_rows($relatedQuery) > 0){ ?>

<section
class="section"
style="
padding-top:0;
">

    <div class="container-pro">

        <!-- TITLE -->
        <div
        style="
        text-align:center;
        margin-bottom:50px;
        "

        data-aos="fade-up">

            <p class="subtitle">

                Related Articles

            </p>

            <h2 class="section-title">

                Continue Reading

            </h2>

        </div>

        <!-- GRID -->
        <div class="blog-grid">

            <?php
            while(
            $related =
            mysqli_fetch_assoc(
            $relatedQuery
            )){
            ?>

            <div
            class="blog-card"
            data-aos="fade-up">

                <!-- IMAGE -->
                <img

                src="<?php
                echo !empty($related['image'])
                ? 'assets/uploads/blogs/'.$related['image']
                : 'https://placehold.co/800x600?text=Blog';
                ?>"

                alt="<?php echo $related['title']; ?>">

                <!-- BODY -->
                <div class="bc-body">

                    <div class="bc-meta">

                        <span class="bc-cat">

                            <?php
                            echo $blog['category_name'];
                            ?>

                        </span>

                        <span class="bc-date">

                            <?php

                            echo date(
                            "M d, Y",
                            strtotime(
                            $related['created_at']
                            ));

                            ?>

                        </span>

                    </div>

                    <h3>

                        <?php
                        echo $related['title'];
                        ?>

                    </h3>

                    <p>

                        <?php

                        echo substr(
                        strip_tags(
                        $related['short_description']
                        ),
                        0,
                        120
                        );

                        ?>...

                    </p>

                    <a
                    href="blog-details.php?slug=<?php echo $related['slug']; ?>"
                    class="bc-read">

                        Read More →

                    </a>

                </div>

            </div>

            <?php } ?>

        </div>

    </div>

</section>

<?php } ?>

<?php include 'footer.php'; ?>
