$(document).ready(function() {
    //Open activity popup
    $("#addActivityBtn").click(function() {
        $("#addActivity").addClass("active");
    });

    //Close activity popup
    $("#addActivity .closeBtn").click(function() {
        $("#addActivity").removeClass("active");
    });

    //Submit form
    $('#addActivity form').submit(function(event) {
        var checkboxes = $('.time-of-day-checkbox');
        var isChecked = checkboxes.is(':checked');

        if (!isChecked) {
            alert('Please check at least one checkbox for Time of Day.'); //change this to something other than alert box
            event.preventDefault();  //don't submit if box not checked
            return false;
        }
        return true;
    });

    //Fade in and out error messages and handle close interaction
    $(".error-messages").fadeIn(3000).delay(3000).fadeOut(3000);
    $(".success-messages").fadeIn(3000).delay(3000).fadeOut(3000);


    //Manually close error message
    // $(document).on('click', '.close-error', function(event) {
    //     event.stopPropagation();  //Stop the event from bubbling up to parent elements
    //     $(this).closest('.error-messages').fadeOut(1000);  //Fade out the closest error message container
    // });
});
