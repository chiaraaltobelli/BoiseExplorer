document.getElementById("showLoginBtn").addEventListener("click", function() {
    console.log("Show login button clicked");
    document.getElementById("showLogin").classList.add("active");
    
    document.querySelector("#showLogin .close-btn").addEventListener("click", function() {
        console.log("Close button clicked");
        document.getElementById("showLogin").classList.remove("active");
    });
});
    
    