$(document).ready(function () {
    $( "#search" ).focusout(function() {
        $('#search-results').fadeOut(400);
    });

    $( "#search" ).focus(function() {
        $('#search-results').fadeIn(400);
    });

});
