<?php
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    $loginText = "Logout";
    $loginAction = "logout.php";
} else {
    $loginText = "Login";
    $loginAction = "#"; // prevent the button from redirecting
}
?>

<!-- Login/Logout Button -->
<div>
    <?php if ($loginText === "Login"): ?>
        <a href="<?php echo $loginAction; ?>" id="showLoginBtn" class="sign-in-btn">
            <h3><?php echo $loginText; ?></h3>
            <img src="images/user.png" alt="<?php echo $loginText; ?>" class="signin-icon">
        </a>
    <?php else: ?>
        <a href="<?php echo $loginAction; ?>" class="sign-in-btn" id="showLoginBtn">
            <h3><?php echo $loginText; ?></h3>
            <img src="images/user.png" alt="<?php echo $loginText; ?>" class="signin-icon">
        </a>
    <?php endif; ?>
</div>

<!-- JavaScript to handle opening the login popup -->
<script src="login.js"></script>
