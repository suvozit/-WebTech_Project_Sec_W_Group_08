    </div> <!-- .container end -->

    <footer class="site-footer">
        <div class="footer-cols">
            <div class="footer-brand">
                <h3>Smart Clothing</h3>
                <p>Modern essentials and everyday fashion. Simple pieces, made to last, for men and women.</p>
            </div>

            <div class="footer-col">
                <h4>Shop</h4>
                <a href="<?php echo BASE_URL; ?>?action=filter_products">All Products</a>
                <a href="<?php echo BASE_URL; ?>?action=filter_products&gender=Men">Men</a>
                <a href="<?php echo BASE_URL; ?>?action=filter_products&gender=Women">Women</a>
                <a href="<?php echo BASE_URL; ?>?action=home">New Arrivals</a>
            </div>

            <div class="footer-col">
                <h4>Account</h4>
                <a href="<?php echo BASE_URL; ?>?action=profile">My Profile</a>
                <a href="<?php echo BASE_URL; ?>?action=my_orders">My Orders</a>
                <a href="<?php echo BASE_URL; ?>?action=cart">Cart</a>
                <a href="<?php echo BASE_URL; ?>?action=login">Login</a>
            </div>

            <div class="footer-news">
                <h4>Newsletter</h4>
                <p>Subscribe for new drops and offers.</p>
                <form onsubmit="return false;">
                    <input type="email" placeholder="Your email address" aria-label="Email address">
                    <button type="submit">Join</button>
                </form>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?php echo date('Y'); ?> Smart Clothing Store. All rights reserved.
            <div class="footer-pay">
                <span>VISA</span><span>MASTERCARD</span><span>BKASH</span><span>COD</span>
            </div>
        </div>
    </footer>

</body>
</html>
