
<?php

include '../includes/db.php';

/* =========================
CHECK ID
========================= */

if(!isset($_GET['id'])){

    header(
    "Location: manage-products.php"
    );

    exit;
}

$id = intval($_GET['id']);

/* =========================
FETCH PRODUCT
========================= */

$query = mysqli_query($conn,"

SELECT *
FROM products

WHERE id='$id'

LIMIT 1

");

if(mysqli_num_rows($query) == 0){

    header(
    "Location: manage-products.php"
    );

    exit;
}

$product =
mysqli_fetch_assoc($query);

/* =========================
DELETE IMAGE
========================= */

$imagePath =
'../../uploads/products/' .
$product['image'];

if(
file_exists($imagePath)
){

    unlink($imagePath);
}

/* =========================
DELETE PRODUCT
========================= */

mysqli_query($conn,"

DELETE FROM products

WHERE id='$id'

");

/* =========================
REDIRECT
========================= */

header(
"Location: manage-products.php"
);

exit;

?>

