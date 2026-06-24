<?php

session_start();

include '../includes/db.php';

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = mysqli_query($conn, "

        SELECT *
        FROM admins
        WHERE email='$email'
        LIMIT 1

    ");

    if (mysqli_num_rows($query) > 0) {

        $admin = mysqli_fetch_assoc($query);

        // MD5 Password Check
        if (
            md5($password) == $admin['password']
        ) {

            $_SESSION['admin_id']
                = $admin['id'];

            $_SESSION['admin_name']
                = $admin['name'];

            header(
                "Location: dashboard.php"
            );

            exit;
        }
    }

    $error = "Invalid Email or Password";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Tricono Admin Login</title>
     <link rel="icon" type="image/png" href="assets/logo/favicon.png">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(135deg,
                    #071739 0%,
                    #0b2d63 100%);

            font-family: 'Poppins', sans-serif;

            overflow: hidden;

            position: relative;
        }

        body::before {

            content: '';

            position: absolute;

            width: 500px;
            height: 500px;

            background:
                rgba(255, 255, 255, 0.05);

            border-radius: 50%;

            top: -200px;
            left: -150px;
        }

        body::after {

            content: '';

            position: absolute;

            width: 450px;
            height: 450px;

            background:
                rgba(255, 255, 255, 0.04);

            border-radius: 50%;

            bottom: -180px;
            right: -120px;
        }

        .login-card {

            width: 100%;
            max-width: 430px;

            background: #ffffff;

            border-radius: 30px;

            padding: 45px;

            box-shadow:
                0 25px 70px rgba(0, 0, 0, 0.25);

            position: relative;

            z-index: 2;
        }

        .login-logo {

            text-align: center;

            margin-bottom: 35px;
        }

        .login-logo img {

            height: 70px;

            object-fit: contain;
        }

        .login-logo h2 {

            margin-top: 18px;

            font-size: 28px;

            font-weight: 700;

            color: #071739;
        }

        .login-logo p {

            color: #7d8794;

            margin-top: 8px;

            font-size: 14px;
        }

        .form-label {

            font-size: 14px;

            font-weight: 600;

            margin-bottom: 8px;

            color: #1e293b;
        }

        .input-group {

            border: 1px solid #dbe2ea;

            border-radius: 14px;

            overflow: hidden;

            transition: .3s;
        }

        .input-group:focus-within {

            border-color: #2ca24c;

            box-shadow:
                0 0 0 4px rgba(44, 162, 76, 0.12);
        }

        .input-group-text {

            background: #fff;

            border: none;

            color: #64748b;

            padding-left: 18px;
        }

        .form-control {

            border: none;

            height: 56px;

            font-size: 15px;
        }

        .form-control:focus {

            box-shadow: none;
        }

        .btn-login {

            height: 58px;

            border: none;

            border-radius: 14px;

            background:
                linear-gradient(135deg,
                    #2ca24c,
                    #22863d);

            color: #fff;

            font-size: 16px;

            font-weight: 600;

            transition: .3s;
        }

        .btn-login:hover {

            transform: translateY(-2px);

            box-shadow:
                0 12px 25px rgba(44, 162, 76, 0.28);
        }

        .alert {

            border-radius: 14px;

            font-size: 14px;
        }

        .footer-text {

            text-align: center;

            margin-top: 25px;

            font-size: 13px;

            color: #94a3b8;
        }
    </style>

</head>

<body>

    <div class="login-card">

        <div class="login-logo">

            <img src="../assets/logo/logo.png">

            <h2>Admin Panel</h2>

            <p>
                Welcome back! Please login to continue.
            </p>

        </div>

        <?php if (isset($error)) { ?>

            <div class="alert alert-danger">

                <i class="fa fa-circle-exclamation me-2"></i>

                <?php echo $error; ?>

            </div>

        <?php } ?>

        <form method="POST">

            <div class="mb-4">

                <label class="form-label">

                    Email Address

                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="fa fa-envelope"></i>

                    </span>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Enter your email"
                        required>

                </div>

            </div>

            <div class="mb-4">

                <label class="form-label">

                    Password

                </label>

                <div class="input-group">

                    <span class="input-group-text">

                        <i class="fa fa-lock"></i>

                    </span>

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required>

                </div>

            </div>

            <button
                type="submit"
                name="login"
                class="btn btn-login w-100">

                <i class="fa fa-right-to-bracket me-2"></i>

                Login Now

            </button>

        </form>

        <div class="footer-text">

            © <?php echo date('Y'); ?> Tricono Admin Panel

        </div>

    </div>

</body>

</html>