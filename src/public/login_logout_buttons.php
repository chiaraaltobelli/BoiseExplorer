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
            <img src="../../images/user.png" alt="<?php echo $loginText; ?>" class="signin-icon">
        </a>
    <?php else: ?>
        <a href="<?php echo $loginAction; ?>" class="sign-in-btn" id="showLoginBtn">
            <h3><?php echo $loginText; ?></h3>
            <img src="../../images/user.png" alt="<?php echo $loginText; ?>" class="signin-icon">
        </a>
    <?php endif; ?>
</div>

<!-- JavaScript to handle opening the login popup -->
<script src="login.js"></script>

<!-- PHP to handle incorrect credentials -->
<?php if(isset($_GET['login_error']) && $_GET['login_error'] === 'incorrect_credentials'): ?>
<script>
    //Javascript to open the popup
    document.addEventListener("DOMContentLoaded", function() {
        var showLoginPopup = document.getElementById("showLogin");
        if (showLoginPopup) {
            showLoginPopup.classList.add("active");
        }
        //Allow user to close box and opt out of login
        var closeBtn = document.querySelector("#showLogin .close-btn");
        if (closeBtn) {
            closeBtn.addEventListener("click", function() {
                showLoginPopup.classList.remove("active");
                removeIncorrectLoginQueryString();
            });
        }
    });
    //Get rid of incorrect credentials query string if 'x' is clicked
    function removeIncorrectLoginQueryString() {
        if (window.location.search.indexOf('login_error=incorrect_credentials') !== -1) {
            var newUrl = window.location.href.replace('?login_error=incorrect_credentials', '');
            history.replaceState({}, document.title, newUrl);
        }
    }
</script>
<?php endif; ?>
