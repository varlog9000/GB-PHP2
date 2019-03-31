var a1 = $("#list").html();
$("#more").click(function () {
    $("#hidden").load('generate_ajax.php', 'more');

});
$("#more").click(function () {
    var a = $("#list").html()+$("#hidden").html();
    $("#list").html(a);
});