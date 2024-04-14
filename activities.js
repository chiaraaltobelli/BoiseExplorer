$(document).ready(function() {
    // Handle the opening of the activity popup
    $("#addActivityBtn").click(function() {
        $("#addActivity").addClass("active");
    });

    // Handle the closing of the activity popup
    $("#addActivity .closeBtn").click(function() {
        $("#addActivity").removeClass("active");
    });

    // Handle form submission with validation for the time of day checkboxes
    $('#addActivity form').submit(function(event) {
        var checkboxes = $('.time-of-day-checkbox');
        var isChecked = checkboxes.is(':checked');

        if (!isChecked) {
            alert('Please check at least one checkbox for Time of Day.');
            event.preventDefault();  // Prevent form from submitting
            return false;
        }
        return true;
    });

    // Fade in and out error messages and handle close interaction
    $(".error-messages").fadeIn(3000).delay(3000).fadeOut(3000);

    //Manually close error message
    // $(document).on('click', '.close-error', function(event) {
    //     event.stopPropagation();  // Stop the event from bubbling up to parent elements
    //     $(this).closest('.error-messages').fadeOut(1000);  // Fade out the closest error message container
    // });
});
