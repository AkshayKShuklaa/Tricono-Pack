
<?php

include '../includes/db.php';

if(
isset($_GET['id'])
&&
isset($_GET['status'])
){

    $id = intval($_GET['id']);

    $status =
    mysqli_real_escape_string(
        $conn,
        $_GET['status']
    );

    mysqli_query($conn,"

    UPDATE blogs

    SET status='$status'

    WHERE id='$id'

    ");
}

header("Location: manage-blogs.php");

exit;

?>

