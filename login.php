
        <!-- Login Popup -->
        <div id="showLogin" class="popup">
            <div class="close-btn">&times;</div>
            <div class="form">
                <h2>Login</h2>
                <!-- <?php 
                if (!isset($_SESSION['authenticated'])) {
                    $_SESSION['authenticated'] = false;
                }
                if(isset($_SESSION['loginerror']) && $_SESSION['loginerror'] === true) {
                    echo "<p class='loginerror'>Incorrect username or password.</p>";
                }
                ?>  -->
                <!-- Form -->
                <form method="post" action="login_handler.php" id="loginForm">
                <div class="form-element">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter email" autocomplete="email" required>
                </div>
                <div class="form-element">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
                </div>
                <!-- <div class="form-element">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember me</label>
                </div> -->
                <div class="form-element">
                    <button type="submit">Login</button>
                </div>
                <div class="form-element" id="create">
                    <a href="create_account.php">Create Account</a>
                </div>
                <!-- <div class="form-element" id="forgot">
                    <a href="#" id="forgot">Forgot password?</a>
                </div> -->
                </form>
        </div>
    </div>


