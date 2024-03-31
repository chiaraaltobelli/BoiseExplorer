document.addEventListener("DOMContentLoaded", function() {
    var addActivityBtn = document.getElementById("addActivityBtn");
    if (addActivityBtn) {
        addActivityBtn.addEventListener("click", function() {
            var addActivityPopup = document.getElementById("addActivity");
            if (addActivityPopup) {
                addActivityPopup.classList.add("active");
                var closeBtn = document.querySelector("#addActivity .closeBtn");
                if (closeBtn) {
                    closeBtn.addEventListener("click", function() {
                        addActivityPopup.classList.remove("active");
                    });
                }
            }
        });
    }
});
