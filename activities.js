document.getElementById("addActivityBtn").addEventListener("click", function() {
    document.getElementById("addactivity").classList.add("active");
    
    document.querySelector("#addactivity .close-btn").addEventListener("click", function() {
        document.getElementById("addactivity").classList.remove("active");
    });
});
