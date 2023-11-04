$(document).ready(function() {

    //on Click signup, hide login and show registrationform
    $("#signup").click(function() {
        $("#first").slideUp("slow", function(){
            $("#second").slideDown("slow");
        });
    });

     //on Click signup, hide registration and show login
     $("#signin").click(function() {
        $("#second").slideUp("slow", function(){
            $("#first").slideDown("slow");
        });
    });

});