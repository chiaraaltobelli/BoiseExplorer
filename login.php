
        <!-- Popup -->
        <div id="showLogin" class="popup">
            <div class="close-btn">&times;</div>
            <div class="form">
                <h2>Login</h2>
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
                <div class="form-element">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div class="form-element">
                    <button type="submit">Login</button>
                </div>
                <div class="form-element">
                    <a href="#">Forgot password?</a>
                </div>
                </form>
        </div>
    </div>
