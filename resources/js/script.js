$(document).ready(function () {
    $( "#search" ).focusout(function() {
        $('#search-results').fadeOut(400);
    });

    $( "#search" ).focus(function() {
        $('#search-results').fadeIn(400);
    });


    $('.js-delete-post').click(function (e) {
        if(!confirm("Do you really want delete the post?")) {
            e.preventDefault();
            return false;
        }
        $('.delete-form').submit();
    });
});
