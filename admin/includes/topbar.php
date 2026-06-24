<div class="topbar">

    <div class="topbar-title">

        <h4>

            <?php echo $pageTitle; ?>

        </h4>

        <p>
            Welcome back,
            <?php echo $_SESSION['admin_name']; ?>
        </p>

    </div>

    <div class="admin-user">

        <img
            src="<?php echo ADMIN_URL; ?>assets/logo/logo.png">

        <div>

            <h5>

                <?php echo $_SESSION['admin_name']; ?>

            </h5>

            <span>Administrator</span>

        </div>

    </div>

</div>