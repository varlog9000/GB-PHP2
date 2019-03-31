$(document).ready(function () {
    $("#more").click(function () {
        $.ajax({
            url: "generate_ajax.php?&more",
            cache: false,
            type: "GET",
            dataType: "text"
    }).done(function( html ) {
            $("#list").append(html);
        });
    });
});
