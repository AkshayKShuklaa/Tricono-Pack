
<?php

include '../includes/db.php';

$pageTitle = "Contact Inquiries";

include '../includes/header.php';

/* =========================
FETCH INQUIRIES
========================= */

$query = mysqli_query($conn, "

SELECT *
FROM contact_inquiries

ORDER BY id DESC

");

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
                        Contact Inquiries
                    </h4>

                    <p
                    style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Manage website contact form submissions

                    </p>

                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table
                class="table datatable align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Name</th>

                            <th>Company</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th width="180">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        while(
                        $row =
                        mysqli_fetch_assoc($query)
                        ){
                        ?>

                        <tr>

                            <!-- ID -->
                            <td>

                                #<?php echo $row['id']; ?>

                            </td>

                            <!-- NAME -->
                            <td>

                                <div>

                                    <h6
                                    style="
                                    font-weight:700;
                                    margin-bottom:5px;
                                    ">

                                        <?php
                                        echo
                                        $row['first_name']
                                        .' '.
                                        $row['last_name'];
                                        ?>

                                    </h6>

                                    <small
                                    style="
                                    color:#667085;
                                    ">

                                        <?php
                                        echo
                                        $row['product_interest'];
                                        ?>

                                    </small>

                                </div>

                            </td>

                            <!-- COMPANY -->
                            <td>

                                <?php
                                echo
                                $row['company'];
                                ?>

                            </td>

                            <!-- EMAIL -->
                            <td>

                                <?php
                                echo
                                $row['email'];
                                ?>

                            </td>

                            <!-- PHONE -->
                            <td>

                                <?php
                                echo
                                $row['phone'];
                                ?>

                            </td>

                            <!-- STATUS -->
                            <td>

                                <?php
                                if(
                                $row['status']
                                == 'new'
                                ){
                                ?>

                                    <span
                                    style="
                                    background:#eef5ff;
                                    color:#0d6efd;
                                    padding:8px 14px;
                                    border-radius:40px;
                                    font-size:13px;
                                    font-weight:700;
                                    ">

                                        New

                                    </span>

                                <?php } ?>

                                <?php
                                if(
                                $row['status']
                                == 'contacted'
                                ){
                                ?>

                                    <span
                                    style="
                                    background:#ecfdf3;
                                    color:#2ca24c;
                                    padding:8px 14px;
                                    border-radius:40px;
                                    font-size:13px;
                                    font-weight:700;
                                    ">

                                        Contacted

                                    </span>

                                <?php } ?>

                                <?php
                                if(
                                $row['status']
                                == 'closed'
                                ){
                                ?>

                                    <span
                                    style="
                                    background:#f4f4f5;
                                    color:#667085;
                                    padding:8px 14px;
                                    border-radius:40px;
                                    font-size:13px;
                                    font-weight:700;
                                    ">

                                        Closed

                                    </span>

                                <?php } ?>

                            </td>

                            <!-- DATE -->
                            <td>

                                <?php

                                echo date(
                                "d M Y",
                                strtotime(
                                $row['created_at']
                                ));

                                ?>

                            </td>

                            <!-- ACTIONS -->
                            <td>

                                <div
                                style="
                                display:flex;
                                gap:10px;
                                ">

                                    <!-- VIEW -->
                                    <button

                                    class="btn btn-sm"

                                    data-bs-toggle="modal"

                                    data-bs-target="#viewModal<?php echo $row['id']; ?>"

                                    style="
                                    width:44px;
                                    height:44px;
                                    border-radius:14px;
                                    background:#eef5ff;
                                    color:#0d6efd;
                                    border:none;
                                    ">

                                        <i class="fas fa-eye"></i>

                                    </button>

                                    <!-- DELETE -->
                                    <a
                                    href="delete-inquiry.php?id=<?php echo $row['id']; ?>"

                                    onclick="
                                    return confirm(
                                    'Delete inquiry?'
                                    )
                                    "

                                    style="
                                    width:44px;
                                    height:44px;
                                    border-radius:14px;
                                    background:#fff1f1;
                                    color:#d93c3c;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    text-decoration:none;
                                    ">

                                        <i class="fas fa-trash"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>

                        <!-- MODAL -->
                        <div
                        class="modal fade"
                        id="viewModal<?php echo $row['id']; ?>">

                            <div
                            class="modal-dialog modal-lg modal-dialog-centered">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5
                                        class="modal-title">

                                            Inquiry Details

                                        </h5>

                                        <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <div class="row">

                                            <div class="col-md-6 mb-4">

                                                <label
                                                class="form-label">

                                                    Name

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['first_name']
                                                    .' '.
                                                    $row['last_name'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-6 mb-4">

                                                <label
                                                class="form-label">

                                                    Company

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['company'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-6 mb-4">

                                                <label
                                                class="form-label">

                                                    Email

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['email'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-6 mb-4">

                                                <label
                                                class="form-label">

                                                    Phone

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['phone'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-12 mb-4">

                                                <label
                                                class="form-label">

                                                    Product Interest

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['product_interest'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-12 mb-4">

                                                <label
                                                class="form-label">

                                                    Quantity Range

                                                </label>

                                                <div>

                                                    <?php
                                                    echo
                                                    $row['quantity_range'];
                                                    ?>

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <label
                                                class="form-label">

                                                    Message

                                                </label>

                                                <div
                                                style="
                                                line-height:1.8;
                                                color:#475467;
                                                ">

                                                    <?php
                                                    echo nl2br(
                                                    $row['message']
                                                    );
                                                    ?>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>

