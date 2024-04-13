<div id="createaccount" class="popup">
    <div id="createAccount" class="close-btn">&times;</div>
    <div class="form">
        <h2>Create New Account</h2>
        <form action="create_account_handler.php" method="post"> <!-- Added action attribute -->
            <div class="form-element">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter email"> <!-- Added name attribute -->
            </div>
            <div class="form-element">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter password"> <!-- Added name attribute -->
            </div>
            <div class="form-element">
                <label for="confirmPassword">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"> <!-- Added name attribute -->
            </div>
            <div class="form-element">
                <input type="checkbox" id="remember-me" name="remember-me"> <!-- Added name attribute -->
                <label for="remember-me">Remember me</label>
            </div>
            <div class="form-element">
                <button type="submit">Create Account</button> <!-- Added type attribute -->
            </div>
        </form>
    </div>
</div>


<script>
    // Function to show the popup when the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".popup").classList.add("active");
    });

    // Event listener to close the popup
    document.querySelector(".popup .close-btn").addEventListener("click", function() {
        document.querySelector(".popup").classList.remove("active");
    });
</script>
