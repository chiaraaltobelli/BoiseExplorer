document.addEventListener("DOMContentLoaded", function() {
    var showLoginBtn = document.getElementById("showLoginBtn");
    if (showLoginBtn) {
        showLoginBtn.addEventListener("click", function() {
            var showLoginPopup = document.getElementById("showLogin");
            if (showLoginPopup) {
                showLoginPopup.classList.add("active");
                
                var closeBtn = showLoginPopup.querySelector(".close-btn");
                if (closeBtn) {
                    closeBtn.addEventListener("click", function() {
                        showLoginPopup.classList.remove("active");
                    });
                }
            }
        });
    }
});
