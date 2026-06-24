
<?php

include '../includes/db.php';

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    mysqli_query($conn, "

    DELETE FROM contact_inquiries

    WHERE id='$id'

    ");
}

header(
"Location: contact-inquiries.php"
);

exit;

?>

