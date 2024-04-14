<!-- Login Popup -->
<div id="showLogin" class="popup">
    <div class="close-btn">&times;</div>
    <div class="form">
        <h2>Login</h2>
        <?php 
        //Display error message for incorrect username or password
        if (isset($_GET['login_error']) && $_GET['login_error'] == 'incorrect_credentials'): ?>
            <p class='error-messages'>Incorrect username or password.</p>
        <?php endif; ?>
        <!-- Form -->
        <form method="post" action="login_handler.php" id="loginForm">
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter email" autocomplete="email" required value="<?= htmlspecialchars($_SESSION['inputs']['email'] ?? '') ?>">
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
            </div>
            <div class="form-element">
                <button type="submit">Login</button>
            </div>
            <div class="form-element" id="create">
                <a href="create_account.php">Create Account</a>
            </div>
        </form>
    </div>
</div>
