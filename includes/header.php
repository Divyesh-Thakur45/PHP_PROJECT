<header class="navbar">
    <!-- Top Bar -->
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="left-links">
                    <a href="#">Do More, Be More</a>
                    <a href="#">Tryin3D</a>
                    <a href="#">Store Locator</a>
                    <a href="#">Singapore</a>
                    <a href="#">UAE</a>
                    <a href="#">John Jacobs</a>
                    <a href="#">Aqualens</a>
                    <a href="#">Cobrowsing</a>
                    <a href="#">Engineering Blog</a>
                    <a href="#">Partner With Us</a>
                </div>
                <div class="right-links">
                    <a href="#">Contact Us</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Bar -->
    <div class="main-bar">
        <div class="container">
            <div class="main-bar-content">
                <div class="logo-section">
                    <a href="/PHP_PROJECT" class="logo">
                        <img src="https://static.lenskart.com/media/desktop/img/site-images/main_logo.svg" alt="Lenskart Logo">
                    </a>
                    <span class="phone-number">
                        <i class="fas fa-phone"></i>
                        1800-202-4444
                    </span>
                </div>

                <div class="search-bar">
                    <form class="search-form">
                        <input type="text" id="searchInput" placeholder="What are you looking for?" class="search-input">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="account-links">
                    <a href="#" class="account-link" id="signUpBtn">
                        <i class="fas fa-user-plus"></i>
                        Sign up
                    </a>
                    <a href="#" class="account-link" id="signInBtn">
                        <i class="fas fa-user"></i>
                        Sign In
                    </a>
                    <a href="#" class="account-link">
                        <i class="fas fa-heart"></i>
                        Wishlist
                    </a>
                    <a href="/PHP_PROJECT/controllers/cart.php" class="account-link cart-link">
                        <i class="fas fa-shopping-cart"></i>
                        Cart
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Navigation Bar -->
    <div class="bottom-bar">
        <div class="container">
            <div class="bottom-bar-content">
                <nav class="main-navigation">
                    <a href="/PHP_PROJECT/pages/eyeglasses.php" class="nav-link">EYEGLASSES</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">SCREEN GLASSES</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">KIDS GLASSES</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">CONTACT LENSES</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">SUNGLASSES</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">HOME EYE-TEST</a>
                    <a href="/PHP_PROJECT/pages/notfound.php" class="nav-link">STORE LOCATOR</a>
                </nav>

                <div class="brand-logos">
                    <img src="https://static1.lenskart.com/media/desktop/img/May22/3dtryon1.png" alt="3D Try On" class="brand-logo">
                    <img src="https://static1.lenskart.com/media/desktop/img/Mar22/13-Mar/blulogo.png" alt="Blue Light" class="brand-logo">
                    <img src="https://static5.lenskart.com/media/uploads/gold_max_logo_dc.png" alt="Gold Max" class="brand-logo">
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <div class="mobile-menu-toggle">
        <button id="mobileMenuBtn" class="mobile-menu-btn">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>

<!-- Sign In Modal -->
<div id="signInModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Sign In</h2>
        <form class="signin-form">
            <div class="form-group">
                <input type="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>
    </div>
</div>


<!-- Sign up Modal -->
<div id="signUpModal" class="modal">
    <div class="modal-content">
        <span class="close" id="closeSignUp">&times;</span>
        <h2>Sign Up</h2>
        <form class="signup-form">
            <div class="form-group">
                <input type="email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="password" placeholder="Confirm Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
    </div>
</div>