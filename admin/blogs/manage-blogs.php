og03"
<?php

include '../includes/db.php';

$pageTitle = "Manage Blogs";

include '../includes/header.php';

/* =========================
FETCH BLOGS
========================= */

$query = mysqli_query($conn,"

SELECT
    b.*,
    bc.name AS category_name

FROM blogs b

LEFT JOIN blog_categories bc
ON bc.id = b.category_id

ORDER BY b.id DESC

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
                        Blog Management
                    </h4>

                    <p
                    style="
                    color:#667085;
                    margin-top:5px;
                    ">

                        Manage all blog articles

                    </p>

                </div>

                <a
                href="add-blog.php"
                class="btn-main">

                    <i class="fas fa-plus"></i>

                    &nbsp;

                    Add Blog

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

                            <th>Blog</th>

                            <th>Category</th>

                            <th>Featured</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th width="220">
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

                            <!-- IMAGE -->
                            <td width="90">

                                <img
                                src="../../assets/uploads/blogs/<?php echo $row['image']; ?>"
                                style="
                                width:70px;
                                height:70px;
                                object-fit:cover;
                                border-radius:18px;
                                border:1px solid #edf1f7;
                                ">

                            </td>

                            <!-- BLOG -->
                            <td>

                                <div>

                                    <h6
                                    style="
                                    font-weight:700;
                                    margin-bottom:5px;
                                    font-size:16px;
                                    ">

                                        <?php echo $row['title']; ?>

                                    </h6>

                                    <div
                                    style="
                                    color:#667085;
                                    font-size:13px;
                                    max-width:320px;
                                    ">

                                        <?php

                                        echo substr(
                                        $row['short_description'],
                                        0,
                                        90
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

                            <!-- FEATURED -->
                            <td>

                                <?php
                                if(
                                $row['is_featured']
                                == 'yes'
                                ){
                                ?>

                                    <span
                                    style="
                                    background:#fff6e8;
                                    color:#ff9800;
                                    padding:8px 14px;
                                    border-radius:40px;
                                    font-size:13px;
                                    font-weight:700;
                                    ">

                                        Featured

                                    </span>

                                <?php } else { ?>

                                    <span
                                    style="
                                    color:#98a2b3;
                                    font-size:13px;
                                    ">

                                        —
                                    </span>

                                <?php } ?>

                            </td>

                            <!-- STATUS -->
                            <td>

                                <?php
                                if(
                                $row['status']
                                == 'active'
                                ){
                                ?>

                                    <a
                                    href="change-status.php?id=<?php echo $row['id']; ?>&status=inactive"
                                    class="
                                    badge-status
                                    badge-active
                                    "
                                    style="
                                    text-decoration:none;
                                    ">

                                        Active

                                    </a>

                                <?php } else { ?>

                                    <a
                                    href="change-status.php?id=<?php echo $row['id']; ?>&status=active"
                                    class="
                                    badge-status
                                    badge-inactive
                                    "
                                    style="
                                    text-decoration:none;
                                    ">

                                        Inactive

                                    </a>

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
                                    <a
                                    href="../../blog-details.php?slug=<?php echo $row['slug']; ?>"
                                    target="_blank"
                                    style="
                                    width:44px;
                                    height:44px;
                                    border-radius:14px;
                                    background:#eef5ff;
                                    color:#0d6efd;
                                    display:flex;
                                    align-items:center;
                                    justify-content:center;
                                    text-decoration:none;
                                    ">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <!-- EDIT -->
                                    <a
                                    href="edit-blog.php?id=<?php echo $row['id']; ?>"
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
                                    ">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <!-- DELETE -->
                                    <a
                                    href="delete-blog.php?id=<?php echo $row['id']; ?>"
                                    onclick="return confirm('Delete this blog?')"
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

                        <?php } ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<?php include '../includes/footer.php'; ?>

