$(document).ready(function () {

//    $('#search_text_input').focus(function () {
//        if (window.matchMedia("(min-width: 992px)").matches) {
//            $(this).animate({width: '250px'}, 500);
//        }
//        const search_text_input = document.querySelector('#search_text_input');
//        const search_results_container = document.querySelector('#search_results_container');
//
//        const width = search_text_input.offsetWidth; // Get the width of element1
//        search_results_container.style.width = width + 'px'; // Set the width of element2
//    });
    $('#search_text_input').focus(function () {
        if (window.matchMedia("(min-width: 992px)").matches) {
            $(this).animate({width: '250px'}, 500, function () {
                // Animation complete.
                const search_text_input = document.querySelector('#search_text_input');
                const search_results_container = document.querySelector('#search_results_container');

                const width = search_text_input.offsetWidth; // Get the width of element1 after expansion
                search_results_container.style.width = width + 'px'; // Update the width of element2
            });
        } else {
            // For smaller screens, you might want to handle the width differently
            // or do nothing at all.
            const search_text_input = document.querySelector('#search_text_input');
            const search_results_container = document.querySelector('#search_results_container');

            const width = search_text_input.offsetWidth; // Get the width of element1 after expansion
            search_results_container.style.width = width + 'px'; // Update the width of element2
        }
    });

    $('.button_holder').on('click', function () {
        document.search_form.submit();
    });

    //Button for profile post
    $('#submit_profile_post').click(function () {

        $.ajax({
            type: "POST",
            url: "includes/handlers/ajax_submit_profile_post.php",
            data: $('form.profile_post').serialize(),
            success: function (msg) {
                $("#post_form").modal('hide');
                location.reload();
            },
            error: function () {
                alert('Failure');
            }
        });

    });


});

$(document).click(function (e) {

    if (e.target.class != "search_results" && e.target.id != "search_text_input") {

        $(".search_results").html("");
        $('.search_results_footer').html("");
        $('.search_results_footer').toggleClass("search_results_footer_empty");
        $('.search_results_footer').toggleClass("search_results_footer");
    }
})

function getLiveSearchUsers(value, user) {

    $.post("includes/handlers/ajax_search.php", {query: value, userLoggedIn: user}, function (data) {

        if ($(".search_results_footer_empty")[0]) {
            $(".search_results_footer_empty").toggleClass("search_results_footer");
            $(".search_results_footer_empty").toggleClass("search_results_footer_empty");
        }

        $('.search_results').html(data);
        $('.search_results_footer').html("<a href='search.php?q=" + value + "'>See All Results</a>");

        if (data = "") {
            $('.search_results_footer').html("");
            $('.search_results_footer').toggleClass("search_results_footer_empty");
            $('.search_results_footer').toggleClass("search_results_footer");
        }

    });
}




