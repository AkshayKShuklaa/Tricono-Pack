<?php

include '../includes/db.php';

$pageTitle = "Add Product";

include '../includes/header.php';

/* =========================
FETCH CATEGORIES
========================= */

$catQuery = mysqli_query($conn, "

SELECT *
FROM product_categories

ORDER BY name ASC

");

/* =========================
ADD PRODUCT
========================= */

if (isset($_POST['submit'])) {

    $category_id =
        mysqli_real_escape_string(
            $conn,
            $_POST['category_id']
        );

    $name =
        mysqli_real_escape_string(
            $conn,
            $_POST['name']
        );

    $slug =
        strtolower(
            trim(
                preg_replace(
                    '/[^A-Za-z0-9-]+/',
                    '-',
                    $name
                )
            )
        );

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

    $features =
        mysqli_real_escape_string(
            $conn,
            $_POST['features']
        );

    $material =
        mysqli_real_escape_string(
            $conn,
            $_POST['material']
        );

    $sizes =
        mysqli_real_escape_string(
            $conn,
            $_POST['sizes']
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

    if (isset($_FILES['image']['name'])) {

        $image =
            time() . '_' . $_FILES['image']['name'];

        $tmp =
            $_FILES['image']['tmp_name'];

        move_uploaded_file(
            $tmp,
            '../../assets/uploads/products/' . $image
        );
    }

    /* =========================
    INSERT
    ========================= */

    mysqli_query($conn, "

    INSERT INTO products
    (
        category_id,
        name,
        slug,
        short_description,
        description,
        material,
        sizes,
        features,
        image,
        status,
        meta_title,
        meta_description
    )

    VALUES
    (
        '$category_id',
        '$name',
        '$slug',
        '$short_description',
        '$description',
        '$material',
        '$sizes',
        '$features',
        '$image',
        '$status',
        '$meta_title',
        '$meta_description'
    )

    ");

    header(
        "Location: manage-products.php"
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

        <!-- CARD -->
        <div class="table-card">

            <!-- HEADER -->
            <div class="table-card-header">

                <div>

                    <h4>
                        Add Product
                    </h4>

                    <p
                        style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Create a new packaging product

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

                        <!-- PRODUCT NAME -->
                        <div class="mb-4">

                            <label class="form-label">

                                Product Name

                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control admin-input"
                                required>

                        </div>

                        <!-- SHORT DESCRIPTION -->
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

                        <!-- DESCRIPTION -->
                        <div class="mb-4">

                            <label class="form-label">

                                Full Description

                            </label>

                            <textarea
                                name="description"
                                class="form-control admin-textarea"
                                rows="7"></textarea>

                        </div>

                        <!-- FEATURES -->
                        <div class="mb-4">

                            <label class="form-label">

                                Features
                            </label>

                            <textarea
                                name="features"
                                class="form-control admin-textarea"
                                rows="4"
                                placeholder="Example:
High strength,UV stabilized,Reusable"></textarea>

                        </div>

                        <!-- SPECS -->
                        <div class="row">

                            <div class="col-md-6">

                                <div class="mb-4">

                                    <label class="form-label">

                                        Material

                                    </label>

                                    <input
                                        type="text"
                                        name="material"
                                        class="form-control admin-input">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="mb-4">

                                    <label class="form-label">

                                        Sizes

                                    </label>

                                    <input
                                        type="text"
                                        name="sizes"
                                        class="form-control admin-input">

                                </div>

                            </div>

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
                                while (
                                    $cat =
                                    mysqli_fetch_assoc(
                                        $catQuery
                                    )
                                ) {
                                ?>

                                    <option
                                        value="<?php echo $cat['id']; ?>">

                                        <?php echo $cat['name']; ?>

                                    </option>

                                <?php } ?>

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

                                Product Image

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

                            Save Product

                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function previewImage(event) {

        const reader =
            new FileReader();

        reader.onload = function() {

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