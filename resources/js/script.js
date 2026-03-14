$(document).ready(function (){
    $("#header_username").click(function (e) {
        e.stopPropagation();
        $("#header_dropDown_profileMenu").toggle();

        $("#header_arrow").toggleClass("rotate");
    });

    $(document).click(function () {
        $("#header_dropDown_profileMenu").hide();
        $("#header_arrow").removeClass("rotate");
    });

    $("#header_dropDown_profileMenu").click(function (e) {
        e.stopPropagation();
    });
})
