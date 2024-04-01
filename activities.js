console.log("DOM loaded");
var addActivityBtn = document.getElementById("addActivityBtn");
if (addActivityBtn) {
    console.log("Add activity button found");
    addActivityBtn.addEventListener("click", function() {
        console.log("Add activity button clicked");
        var addActivityPopup = document.getElementById("addActivity");
        if (addActivityPopup) {
            console.log("Add activity popup found");
            addActivityPopup.classList.add("active");
            var closeBtn = document.querySelector("#addActivity .closeBtn");
            if (closeBtn) {
                console.log("Close button found");
                closeBtn.addEventListener("click", function() {
                    console.log("Close button clicked");
                    addActivityPopup.classList.remove("active");
                });
            }
        }
    });
}
