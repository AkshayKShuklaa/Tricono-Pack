
<?php

include '../includes/db.php';

$pageTitle = "Edit Blog";

include '../includes/header.php';

/* =========================
CHECK ID
========================= */

if(!isset($_GET['id'])){

    header("Location: manage-blogs.php");
    exit;
}

$id = intval($_GET['id']);

/* =========================
FETCH BLOG
========================= */

$blogQuery = mysqli_query($conn,"

SELECT *
FROM blogs

WHERE id='$id'

LIMIT 1

");

if(mysqli_num_rows($blogQuery) == 0){

    header("Location: manage-blogs.php");
    exit;
}

$blog =
mysqli_fetch_assoc($blogQuery);

/* =========================
FETCH CATEGORIES
========================= */

$catQuery = mysqli_query($conn,"

SELECT *
FROM blog_categories

ORDER BY name ASC

");

/* =========================
UPDATE BLOG
========================= */

if(isset($_POST['update'])){

    $category_id =
    mysqli_real_escape_string(
        $conn,
        $_POST['category_id']
    );

    $title =
    mysqli_real_escape_string(
        $conn,
        $_POST['title']
    );

    $slug =
    strtolower(
    trim(
    preg_replace(
    '/[^A-Za-z0-9-]+/',
    '-',
    $title
    )));

    $short_description =
    mysqli_real_escape_string(
        $conn,
        $_POST['short_description']
    );

    $description =
    mysqli_real_escape_string(
        $conn,
        $_POST['description']
    );

    $is_featured =
    mysqli_real_escape_string(
        $conn,
        $_POST['is_featured']
    );

    $status =
    mysqli_real_escape_string(
        $conn,
        $_POST['status']
    );

    $meta_title =
    mysqli_real_escape_string(
        $conn,
        $_POST['meta_title']
    );

    $meta_description =
    mysqli_real_escape_string(
        $conn,
        $_POST['meta_description']
    );

    /* =========================
    IMAGE UPDATE
    ========================= */

    $image = $blog['image'];

    if(
    !empty($_FILES['image']['name'])
    ){

        $image =
        time().'_'.$_FILES['image']['name'];

        $tmp =
        $_FILES['image']['tmp_name'];

        move_uploaded_file(
            $tmp,
            '../../assets/uploads/blogs/'.$image
        );
    }

    /* =========================
    UPDATE QUERY
    ========================= */

    mysqli_query($conn,"

    UPDATE blogs

    SET

    category_id='$category_id',
    title='$title',
    slug='$slug',
    short_description='$short_description',
    description='$description',
    image='$image',
    is_featured='$is_featured',
    status='$status',
    meta_title='$meta_title',
    meta_description='$meta_description'

    WHERE id='$id'

    ");

    header(
    "Location: manage-blogs.php"
    );

    exit;
}

?>

<!-- SIDEBAR -->
<?php include '../includes/sidebar.php'; ?>

<!-- MAIN -->
<div class="main-content">

    <!-- TOPBAR -->
    <?php include '../includes/topbar.php'; ?>

    <!-- CONTENT -->
    <div class="content-wrapper">

        <div class="table-card">

            <!-- HEADER -->
            <div class="table-card-header">

                <div>

                    <h4>
                        Edit Blog
                    </h4>

                    <p
                    style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Update blog article

                    </p>

                </div>

            </div>

            <!-- FORM -->
            <form
            method="POST"
            enctype="multipart/form-data">

                <div class="row">

                    <!-- LEFT -->
                    <div class="col-lg-8">

                        <!-- TITLE -->
                        <div class="mb-4">

                            <label class="form-label">

                                Blog Title

                            </label>

                            <input
                            type="text"
                            name="title"
                            class="form-control admin-input"
                            value="<?php echo $blog['title']; ?>"
                            required>

                        </div>

                        <!-- SHORT DESC -->
                        <div class="mb-4">

                            <label class="form-label">

                                Short Description

                            </label>

                            <textarea
                            name="short_description"
                            class="form-control admin-textarea"
                            rows="4"
                            required><?php echo $blog['short_description']; ?></textarea>

                        </div>

                        <!-- CONTENT -->
                        <div class="mb-4">

                            <label class="form-label">

                                Blog Content

                            </label>

                            <textarea
                            name="description"
                            id="editor"
                            class="form-control admin-textarea"
                            rows="12"><?php echo $blog['description']; ?></textarea>

                        </div>

                        <!-- SEO -->
                        <div class="mb-4">

                            <label class="form-label">

                                Meta Title

                            </label>

                            <input
                            type="text"
                            name="meta_title"
                            class="form-control admin-input"
                            value="<?php echo $blog['meta_title']; ?>">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Meta Description

                            </label>

                            <textarea
                            name="meta_description"
                            class="form-control admin-textarea"
                            rows="4"><?php echo $blog['meta_description']; ?></textarea>

                        </div>

                    </div>

                    <!-- RIGHT -->
                    <div class="col-lg-4">

                        <!-- CATEGORY -->
                        <div class="mb-4">

                            <label class="form-label">

                                Category

                            </label>

                            <select
                            name="category_id"
                            class="form-select admin-input"
                            required>

                                <?php
                                while(
                                $cat =
                                mysqli_fetch_assoc(
                                $catQuery
                                )){
                                ?>

                                <option
                                value="<?php echo $cat['id']; ?>"

                                <?php
                                if(
                                $cat['id']
                                ==
                                $blog['category_id']
                                ){
                                    echo "selected";
                                }
                                ?>>

                                    <?php echo $cat['name']; ?>

                                </option>

                                <?php } ?>

                            </select>

                        </div>

                        <!-- FEATURED -->
                        <div class="mb-4">

                            <label class="form-label">

                                Featured Blog

                            </label>

                            <select
                            name="is_featured"
                            class="form-select admin-input">

                                <option
                                value="yes"

                                <?php
                                if(
                                $blog['is_featured']
                                == 'yes'
                                ){
                                    echo "selected";
                                }
                                ?>>

                                    Yes

                                </option>

                                <option
                                value="no"

                                <?php
                                if(
                                $blog['is_featured']
                                == 'no'
                                ){
                                    echo "selected";
                                }
                                ?>>

                                    No

                                </option>

                            </select>

                        </div>

                        <!-- STATUS -->
                        <div class="mb-4">

                            <label class="form-label">

                                Status

                            </label>

                            <select
                            name="status"
                            class="form-select admin-input">

                                <option
                                value="active"

                                <?php
                                if(
                                $blog['status']
                                == 'active'
                                ){
                                    echo "selected";
                                }
                                ?>>

                                    Active

                                </option>

                                <option
                                value="inactive"

                                <?php
                                if(
                                $blog['status']
                                == 'inactive'
                                ){
                                    echo "selected";
                                }
                                ?>>

                                    Inactive

                                </option>

                            </select>

                        </div>

                        <!-- IMAGE -->
                        <div class="mb-4">

                            <label class="form-label">

                                Blog Image

                            </label>

                            <input
                            type="file"
                            name="image"
                            class="form-control admin-input"
                            accept="image/*"
                            onchange="previewImage(event)">

                        </div>

                        <!-- PREVIEW -->
                        <div class="mb-4">

                            <img
                            id="preview"
                            src="../../uploads/blogs/<?php echo $blog['image']; ?>"
                            style="
                            width:100%;
                            border-radius:20px;
                            border:1px solid #edf1f7;
                            ">

                        </div>

                        <!-- BUTTON -->
                        <button
                        type="submit"
                        name="update"
                        class="btn-main w-100">

                            <i class="fas fa-save"></i>

                            &nbsp;

                            Update Blog

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

<script>

CKEDITOR.replace('editor');

function previewImage(event){

    const reader =
    new FileReader();

    reader.onload = function(){

        document
        .getElementById('preview')
        .src = reader.result;
    }

    reader.readAsDataURL(
        event.target.files[0]
    );
}

</script>

<?php include '../includes/footer.php'; ?>

