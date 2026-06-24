
<?php

include 'includes/db.php';

$success = false;

/* =========================
FORM SUBMIT
========================= */

if(isset($_POST['submit'])){

    $first_name =
    mysqli_real_escape_string(
        $conn,
        $_POST['first_name']
    );

    $last_name =
    mysqli_real_escape_string(
        $conn,
        $_POST['last_name']
    );

    $email =
    mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $phone =
    mysqli_real_escape_string(
        $conn,
        $_POST['phone']
    );

    $company =
    mysqli_real_escape_string(
        $conn,
        $_POST['company']
    );

    $product_interest =
    mysqli_real_escape_string(
        $conn,
        $_POST['product_interest']
    );

    $quantity_range =
    mysqli_real_escape_string(
        $conn,
        $_POST['quantity_range']
    );

    $message =
    mysqli_real_escape_string(
        $conn,
        $_POST['message']
    );

    mysqli_query($conn, "

    INSERT INTO contact_inquiries
    (
        first_name,
        last_name,
        email,
        phone,
        company,
        product_interest,
        quantity_range,
        message
    )

    VALUES
    (
        '$first_name',
        '$last_name',
        '$email',
        '$phone',
        '$company',
        '$product_interest',
        '$quantity_range',
        '$message'
    )

    ");

    $success = true;
}

include 'header.php';

?>

<style>

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

body{
    font-family:'Plus Jakarta Sans',sans-serif;
    background:#ffffff;
    color:#081d4d;
}

/* =========================
CONTACT SECTION
========================= */

.contact-grid{
    display:grid;
    grid-template-columns:1fr 1.1fr;
    gap:70px;
    align-items:start;
}

/* =========================
LEFT INFO
========================= */

.contact-info{
    padding-top:20px;
}

.subtitle{
    color:#2ca24c;
    text-transform:uppercase;
    letter-spacing:3px;
    font-size:13px;
    font-weight:700;
    margin-bottom:18px;
}

.contact-info h3{
    font-size:52px;
    line-height:1.1;
    margin-bottom:22px;
    font-weight:800;
    color:#081d4d;
    letter-spacing:-1px;
}

.contact-info > p{
    font-size:17px;
    color:#5d6475;
    line-height:1.9;
    margin-bottom:40px;
}

/* =========================
CONTACT ITEM
========================= */

.ci-item{
    display:flex;
    align-items:flex-start;
    gap:22px;
    margin-bottom:32px;
    padding-bottom:28px;
    border-bottom:1px solid #edf1f7;
}

.ci-icon{
    width:62px;
    height:62px;
    min-width:62px;
    border-radius:18px;
    background:#f5f8fc;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#2ca24c;
    font-size:22px;
}

.ci-item h5{
    font-size:19px;
    margin-bottom:8px;
    color:#081d4d;
    font-weight:700;
}

.ci-item p{
    font-size:15px;
    color:#667085;
    line-height:1.8;
}

/* =========================
SOCIAL
========================= */

.social-links{
    display:flex;
    gap:14px;
    margin-top:35px;
}

.social-links a{
    width:52px;
    height:52px;
    border-radius:16px;
    background:#fff;
    border:1px solid #edf1f7;
    display:flex;
    align-items:center;
    justify-content:center;
    color:#081d4d;
    font-size:18px;
    transition:.35s;
    text-decoration:none;
    box-shadow:0 5px 18px rgba(0,0,0,.04);
}

.social-links a:hover{
    background:#081d4d;
    color:#fff;
    transform:translateY(-4px);
}

/* =========================
FORM
========================= */

.contact-form{
    background:#fff;
    padding:50px;
    border-radius:32px;
    border:1px solid #edf1f7;
    box-shadow:
    0 10px 40px rgba(0,0,0,.04),
    0 2px 10px rgba(0,0,0,.02);
}

.contact-form h3{
    font-size:38px;
    font-weight:800;
    margin-bottom:12px;
    color:#081d4d;
}

.form-sub{
    font-size:16px;
    color:#667085;
    margin-bottom:35px;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:18px;
}

.form-group{
    margin-bottom:22px;
}

.form-group label{
    display:block;
    margin-bottom:10px;
    font-size:14px;
    font-weight:700;
    color:#081d4d;
}

.form-group input,
.form-group select,
.form-group textarea{
    width:100%;
    height:58px;
    border-radius:16px;
    border:1.5px solid #e6ebf2;
    padding:0 18px;
    font-size:15px;
    background:#fafcff;
    transition:.3s;
    font-family:'Plus Jakarta Sans',sans-serif;
}

.form-group textarea{
    height:150px;
    padding-top:18px;
    resize:none;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color:#2ca24c;
    background:#fff;
    outline:none;
    box-shadow:0 0 0 4px rgba(44,162,76,.08);
}

/* =========================
BUTTON
========================= */

.form-submit{
    width:100%;
    height:62px;
    border:none;
    border-radius:18px;
    background:linear-gradient(135deg,#2ca24c,#1f8f3d);
    color:#fff;
    font-size:16px;
    font-weight:700;
    cursor:pointer;
    transition:.35s;
    margin-top:10px;
}

.form-submit:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(44,162,76,.25);
}

/* =========================
SUCCESS MESSAGE
========================= */

.success-message{
    background:#ecfdf3;
    color:#2ca24c;
    padding:18px 22px;
    border-radius:16px;
    font-weight:700;
    margin-bottom:25px;
    border:1px solid #b7ebc6;
}

/* =========================
MAP
========================= */

.map-embed{
    overflow:hidden;
    border-radius:30px;
    box-shadow:0 10px 35px rgba(0,0,0,.05);
}

.map-embed iframe{
    display:block;
    width:100%;
    height:500px;
}

/* =========================
STATS
========================= */

.stats{
    background:#f8fafc;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
}

.stat{
    text-align:center;
    padding:55px 25px;
    border-right:1px solid #e9edf5;
}

.stat:last-child{
    border-right:none;
}

.stat h2{
    font-size:62px;
    font-weight:800;
    color:#081d4d;
    margin-bottom:10px;
}

.stat p{
    color:#667085;
    font-size:16px;
}

/* =========================
RESPONSIVE
========================= */

@media(max-width:992px){

    .contact-grid{
        grid-template-columns:1fr;
    }

    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }
}

@media(max-width:768px){

    .contact-info h3{
        font-size:38px;
    }

    .contact-form{
        padding:30px;
        border-radius:24px;
    }

    .form-row{
        grid-template-columns:1fr;
    }

    .stats-grid{
        grid-template-columns:1fr;
    }

    .stat{
        border-right:none;
        border-bottom:1px solid #e9edf5;
    }

    .stat:last-child{
        border-bottom:none;
    }
}

</style>

<!-- PAGE HERO -->
<section class="page-hero">

    <div class="container-pro">

        <div class="breadcrumb">

            <a href="index.php">Home</a>

            <span>/</span>

            <span style="color:rgba(255,255,255,0.75)">
                Contact
            </span>

        </div>

        <h1 data-aos="fade-right">
            Get in Touch
        </h1>

        <p data-aos="fade-up">
            Our sales team responds within 4 business hours. Let's talk about your packaging needs.
        </p>

    </div>

</section>

<!-- CONTACT -->
<section
class="section"
style="padding-top:80px">

    <div class="container-pro">

        <div
        class="contact-grid"
        data-aos="fade-up">

            <!-- LEFT -->
            <div class="contact-info">

                <p class="subtitle">
                    Contact Us
                </p>

                <h3>
                    We'd love to hear from you
                </h3>

                <p>
                    Whether you need a quote, have a product question or want to discuss a bulk order, our team is ready to help.
                </p>

                <div class="ci-item">

                    <div class="ci-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>

                    <div>

                        <h5>
                            Factory Address
                        </h5>

                        <p>
                            Survey No. 233/2,
                            Opposite Amul Khatrej Cheese Plant,<br>
                            Jibhaipura
                            Ta. Mahemdabad
                            Dist. Kheda, <br>
                            Gujarat.
                            pin -  387130
                        </p>

                    </div>

                </div>

                <div class="ci-item">

                    <div class="ci-icon">
                        <i class="fas fa-phone"></i>
                    </div>

                    <div>

                        <h5>
                            Phone & WhatsApp
                        </h5>

                        <p>
                            +91 98765 43210
                            <br>
                            +91 80000 12345
                        </p>

                    </div>

                </div>

                <div class="ci-item">

                    <div class="ci-icon">
                        <i class="fas fa-envelope"></i>
                    </div>

                    <div>

                        <h5>
                            Email
                        </h5>

                        <p>
                            sales@triconopack.com
                            <br>
                            info@triconopack.com
                        </p>

                    </div>

                </div>

                <div class="social-links">

                    <a href="https://linkedin.com" target="_blank">
                        <i class="fab fa-linkedin-in"></i>
                    </a>

                    <a href="https://instagram.com" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>

                    <a href="https://wa.me/919876543210" target="_blank">
                        <i class="fab fa-whatsapp"></i>
                    </a>

                    <a href="https://youtube.com" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>

                </div>

            </div>

            <!-- FORM -->
            <form
            method="POST"
            class="contact-form"
            data-aos="fade-left">

                <h3>
                    Send Us a Message
                </h3>

                <p class="form-sub">
                    Fill in the form below and we'll get back to you within 4 business hours.
                </p>

                <?php if($success){ ?>

                <div class="success-message">

                    Message sent successfully.
                    Our team will contact you shortly.

                </div>

                <?php } ?>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            First Name *
                        </label>

                        <input
                        type="text"
                        name="first_name"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Last Name *
                        </label>

                        <input
                        type="text"
                        name="last_name"
                        required>

                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group">

                        <label>
                            Email Address *
                        </label>

                        <input
                        type="email"
                        name="email"
                        required>

                    </div>

                    <div class="form-group">

                        <label>
                            Phone Number
                        </label>

                        <input
                        type="tel"
                        name="phone">

                    </div>

                </div>

                <div class="form-group">

                    <label>
                        Company Name
                    </label>

                    <input
                    type="text"
                    name="company">

                </div>

                <div class="form-group">

                    <label>
                        Product Interest
                    </label>

                    <select
                    name="product_interest">

                        <option value="">
                            Select a product category
                        </option>

                        <option>
                            Paper Carry Bags
                        </option>

                        <option>
                            Industrial Packaging Bags
                        </option>

                        <option>
                            Garbage & Bin Liner Bags
                        </option>

                        <option>
                            Printed Packaging Rolls
                        </option>

                        <option>
                            Flexible Pouches & Sachets
                        </option>

                        <option>
                            Stretch / Pallet Film
                        </option>

                        <option>
                            Custom Packaging
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>
                        Estimated Monthly Quantity
                    </label>

                    <select
                    name="quantity_range">

                        <option value="">
                            Select quantity range
                        </option>

                        <option>
                            Under 10,000 units
                        </option>

                        <option>
                            10,000 – 50,000 units
                        </option>

                        <option>
                            50,000 – 500,000 units
                        </option>

                        <option>
                            500,000 – 1 million units
                        </option>

                        <option>
                            Over 1 million units
                        </option>

                    </select>

                </div>

                <div class="form-group">

                    <label>
                        Message
                    </label>

                    <textarea
                    name="message"
                    rows="4"></textarea>

                </div>

                <button
                type="submit"
                name="submit"
                class="form-submit">

                    Send Message &nbsp;→

                </button>

            </form>

        </div>

    </div>

</section>

<!-- MAP -->
<section style="padding:0 0 80px">

    <div class="container-pro">

        <div
        class="map-embed"
        data-aos="fade-up">

            <iframe

            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3559.6955540226487!2d80.34897537615718!3d26.844694576695566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399c4770b127c46d%3A0x1778302a9fbe7b41!2sKanpur%2C%20Uttar%20Pradesh!5e0!3m2!1sen!2sin!4v1717500000000!5m2!1sen!2sin"

            style="border:0"

            allowfullscreen=""

            loading="lazy">

            </iframe>

        </div>

    </div>

</section>

<!-- STATS -->
<section
class="stats"
style="
border-top:1.5px solid var(--gray-light);
">

    <div class="container-pro">

        <div class="stats-grid">

            <div
            class="stat"
            data-aos="fade-up">

                <h2>
                    &lt; 4h
                </h2>

                <p>
                    Average Response Time
                </p>

            </div>

            <div
            class="stat"
            data-aos="fade-up"
            data-aos-delay="80">

                <h2>
                    500+
                </h2>

                <p>
                    Active B2B Clients
                </p>

            </div>

            <div
            class="stat"
            data-aos="fade-up"
            data-aos-delay="160">

                <h2>
                    25+
                </h2>

                <p>
                    Countries We Export To
                </p>

            </div>

            <div
            class="stat"
            data-aos="fade-up"
            data-aos-delay="240">

                <h2>
                    15+
                </h2>

                <p>
                    Years of Manufacturing
                </p>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php'; ?>

