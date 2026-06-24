<!-- ── FOOTER ── -->
<footer class="footer">
    <div class="container-pro">
        <div class="footer-grid">

            <div>
                <div class="footer-logo">
                    <img src="assets/logo/footer_logo_cropped.png" alt="Tricono Pack Logo">
                    <div class="footer-tagline-text">Sustainable Packaging Solutions</div>
                </div>
                <p class="footer-desc">
                    Premium B2B Paper packaging manufacturer delivering durable sustainable solutions globally.
                </p>
            </div>

            <div>
                <h4>Company</h4>
                <a href="about.php">About Us</a>
                <a href="products.php">Products</a>
                <a href="blog.php">Blog</a>
                <a href="contact.php">Contact</a>
            </div>

            <div>
                <h4>Products</h4>
                <a href="products.php">Paper Carry Bags</a>
                <a href="products.php">Industrial Packaging</a>
                <a href="products.php">Garbage Bags</a>
                <a href="products.php">Packaging Rolls</a>
            </div>

            <div>
                <h4>Contact</h4>
                <a href="contact.php"><i class="fas fa-location-dot" style="margin-right:8px;color:var(--green)"></i>Survey No. 233/2,
Opposite Amul Khatrej Cheese Plant,
Jibhaipura
Ta. Mahemdabad
Dist. Kheda, 
Gujarat.
pin -  387130</a>
                <a href="tel:+919876543210"><i class="fas fa-phone" style="margin-right:8px;color:var(--green)"></i>+91 98765 43210</a>
                <a href="mailto:sales@triconopack.com"><i class="fas fa-envelope" style="margin-right:8px;color:var(--green)"></i>sales@triconopack.com</a>
            </div>

        </div>

        <div class="footer-bottom">
            <p>© 2026 Tricono Pack. All rights reserved.</p>
            <p>Sustainable Packaging Solutions</p>
        </div>
    </div>
</footer>

<!-- WhatsApp FAB -->
<a href="https://wa.me/919876543210" class="whatsapp" target="_blank" title="Chat on WhatsApp">
    <i class="fab fa-whatsapp"></i>
</a>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 60
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const counters = document.querySelectorAll('.counter');

        const startCounter = (counter) => {
            const target = +counter.getAttribute('data-target');
            let count = 0;

            const speed = target / 80;

            const updateCount = () => {
                count += speed;

                if (count < target) {
                    counter.innerText = Math.ceil(count);
                    requestAnimationFrame(updateCount);
                } else {
                    counter.innerText = target;
                }
            };

            updateCount();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    startCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        counters.forEach(counter => {
            observer.observe(counter);
        });

    });
</script>

<script>
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('nav-links');

    mobileMenu.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        // Toggle icon between bars and X
        const icon = mobileMenu.querySelector('i');
        icon.classList.toggle('fa-bars');
        icon.classList.toggle('fa-times');
    });
</script>

</body>

</html>