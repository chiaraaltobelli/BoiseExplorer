document.addEventListener("DOMContentLoaded", function() {
    var createAccountForm = document.getElementById("createAccountForm");

    if (createAccountForm) {
        createAccountForm.addEventListener("submit", function(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirm_password").value;

            if (password !== confirmPassword) {
                alert("Passwords do not match");
                event.preventDefault(); // Prevent form submission
            }
        });
    }
});
