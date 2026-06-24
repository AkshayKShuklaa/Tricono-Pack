
<?php

include '../includes/db.php';

if(!isset($_GET['id'])){

    header("Location: manage-blogs.php");
    exit;
}

$id = intval($_GET['id']);

$query = mysqli_query($conn,"

SELECT *
FROM blogs

WHERE id='$id'

LIMIT 1

");

$blog = mysqli_fetch_assoc($query);

/* DELETE IMAGE */

$imagePath =
'../../uploads/blogs/' .
$blog['image'];

if(file_exists($imagePath)){

    unlink($imagePath);
}

/* DELETE BLOG */

mysqli_query($conn,"

DELETE FROM blogs

WHERE id='$id'

");

header("Location: manage-blogs.php");

exit;

?>

