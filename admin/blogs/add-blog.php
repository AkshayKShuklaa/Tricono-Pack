
<?php

include '../includes/db.php';

$pageTitle = "Add Blog";

include '../includes/header.php';

/* =========================
FETCH CATEGORIES
========================= */

$catQuery = mysqli_query($conn,"

SELECT *
FROM blog_categories

ORDER BY name ASC

");

/* =========================
ADD BLOG
========================= */

if(isset($_POST['submit'])){

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
    IMAGE UPLOAD
    ========================= */

    $image = '';

    if(isset($_FILES['image']['name'])){

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
    INSERT
    ========================= */

    mysqli_query($conn,"

    INSERT INTO blogs
    (
        category_id,
        title,
        slug,
        short_description,
        description,
        image,
        is_featured,
        status,
        meta_title,
        meta_description
    )

    VALUES
    (
        '$category_id',
        '$title',
        '$slug',
        '$short_description',
        '$description',
        '$image',
        '$is_featured',
        '$status',
        '$meta_title',
        '$meta_description'
    )

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
                        Add Blog
                    </h4>

                    <p
                    style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Create a new blog article

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
                            required></textarea>

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
                            rows="12"></textarea>

                        </div>

                        <!-- SEO -->
                        <div class="mb-4">

                            <label class="form-label">

                                Meta Title

                            </label>

                            <input
                            type="text"
                            name="meta_title"
                            class="form-control admin-input">

                        </div>

                        <div class="mb-4">

                            <label class="form-label">

                                Meta Description

                            </label>

                            <textarea
                            name="meta_description"
                            class="form-control admin-textarea"
                            rows="4"></textarea>

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

                                <option value="">
                                    Select Category
                                </option>

                                <?php
                                while(
                                $cat =
                                mysqli_fetch_assoc(
                                $catQuery
                                )){
                                ?>

                                <option
                                value="<?php echo $cat['id']; ?>">

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

                                <option value="no">

                                    No

                                </option>

                                <option value="yes">

                                    Yes

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

                                <option value="active">

                                    Active

                                </option>

                                <option value="inactive">

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
                            src="https://placehold.co/600x500?text=Preview"
                            style="
                            width:100%;
                            border-radius:20px;
                            border:1px solid #edf1f7;
                            ">

                        </div>

                        <!-- BUTTON -->
                        <button
                        type="submit"
                        name="submit"
                        class="btn-main w-100">

                            <i class="fas fa-save"></i>

                            &nbsp;

                            Publish Blog

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

