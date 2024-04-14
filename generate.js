document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('generate-button').addEventListener('click', function(event){
        event.preventDefault(); // Prevent the form from submitting through normal means

        var activityType = document.getElementById('activity').value;
        var xhr = new XMLHttpRequest(); // Create a new instance of XMLHttpRequest
        xhr.open('POST', 'generate_handler.php', true); // Configure it to send a POST request to 'generate_handler.php'
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); // Set the correct header for form data submission

        // Define what happens when the server response is loaded
        xhr.onload = function() {
            if(xhr.status >= 200 && xhr.status < 300) {
                // Success logic here
                document.getElementById('activities-container').innerHTML = xhr.responseText; // Display the response text in the 'activities-container'
            } else {
                // Error logic here
                console.error('The request failed.');
            }
        };
        xhr.send('type=' + activityType); // Send the request to the server with the selected activity type
    });
});
