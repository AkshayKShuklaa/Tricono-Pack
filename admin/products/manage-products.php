<?php

include '../includes/db.php';

$pageTitle = "Manage Products";

include '../includes/header.php';

/* =========================
FETCH PRODUCTS
========================= */

$query = mysqli_query($conn, "

SELECT
    p.*,
    pc.name AS category_name

FROM products p

LEFT JOIN product_categories pc
ON pc.id = p.category_id

ORDER BY p.id DESC

");

?>

<!-- SIDEBAR -->
<?php include '../includes/sidebar.php'; ?>

<!-- MAIN CONTENT -->
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
                        Product Management
                    </h4>

                    <p
                        style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Manage all packaging products

                    </p>

                </div>

                <a
                    href="add-product.php"
                    class="btn-main">

                    <i class="fas fa-plus"></i>

                    &nbsp;

                    Add Product

                </a>

            </div>

            <!-- TABLE -->
            <div class="table-responsive">

                <table
                    class="table datatable align-middle">

                    <thead>

                        <tr>

                            <th>ID</th>

                            <th>Image</th>

                            <th>Product</th>

                            <th>Category</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th width="170">
                                Actions
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php
                        while (
                            $row =
                            mysqli_fetch_assoc($query)
                        ) {
                        ?>

                            <tr>

                                <!-- ID -->
                                <td>

                                    #<?php echo $row['id']; ?>

                                </td>

                                <!-- IMAGE -->
                                <td width="90">

                                    <img
                                        src="../../assets/uploads/products/<?php echo $row['image']; ?>"
                                        style="
                                width:70px;
                                height:70px;
                                object-fit:cover;
                                border-radius:18px;
                                border:1px solid #edf1f7;
                                ">

                                </td>

                                <!-- PRODUCT -->
                                <td>

                                    <div>

                                        <h6
                                            style="
                                    font-weight:700;
                                    margin-bottom:5px;
                                    font-size:16px;
                                    ">

                                            <?php echo $row['name']; ?>

                                        </h6>

                                        <div
                                            style="
                                    color:#667085;
                                    font-size:13px;
                                    max-width:300px;
                                    ">

                                            <?php

                                            echo substr(
                                                $row['short_description'],
                                                0,
                                                80
                                            );

                                            ?>...

                                        </div>

                                    </div>

                                </td>

                                <!-- CATEGORY -->
                                <td>

                                    <span
                                        style="
                                background:#f4f7fb;
                                color:#081d4d;
                                padding:9px 16px;
                                border-radius:50px;
                                font-size:13px;
                                font-weight:700;
                                ">

                                        <?php echo $row['category_name']; ?>

                                    </span>

                                </td>

                                <!-- STATUS -->
                                <td>

                                    <?php
                                    if (
                                        $row['status']
                                        == 'active'
                                    ) {
                                    ?>

                                        <span
                                            class="
                                    badge-status
                                    badge-active
                                    ">

                                            Active

                                        </span>

                                    <?php } else { ?>

                                        <span
                                            class="
                                    badge-status
                                    badge-inactive
                                    ">

                                            Inactive

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
                                        )
                                    );

                                    ?>

                                </td>

                                <!-- ACTIONS -->
                                <td>

                                    <div
                                        style="
                                display:flex;
                                gap:10px;
                                ">

                                        <!-- EDIT -->
                                        <a
                                            href="edit-product.php?id=<?php echo $row['id']; ?>"
                                            style="
                                    width:44px;
                                    height:44px;
                                    border-radius:14px;
                                    background:#f4f7fb;
                                    color:#081d4d;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    text-decoration:none;
                                    transition:.3s;
                                    ">

                                            <i class="fas fa-edit"></i>

                                        </a>
                                        <a href="../../product-details.php?slug=<?php echo $row['slug']; ?>" target="_blank" style=" width:44px; height:44px; border-radius:14px; background:#eef5ff; color:#0d6efd; display:flex; align-items:center; justify-content:center; text-decoration:none; transition:.3s; "> <i class="fas fa-eye"></i> </a>

                                        <!-- DELETE -->
                                        <a
                                            href="delete-product.php?id=<?php echo $row['id']; ?>"
                                            onclick="return confirm('Delete this product?')"
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
                                    transition:.3s;
                                    ">

                                            <i class="fas fa-trash"></i>

                                        </a>


                                    </div>

                                </td>

                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>