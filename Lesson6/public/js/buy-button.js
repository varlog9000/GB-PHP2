$(function () {
    $(".buy-button").click(function (e) {
        // console.log(e);
        e.preventDefault();
        var _this = this;
        var id = $(_this).attr('add-to-cart');
        $.ajax({
            type: 'GET',
            url: 'index.php?path=cart/add/' + id,
            dataType: 'text',
            success: function (answer) {
                $("#cart-small").html(answer);
            },
            error: function (answer) {
                alert("Ошибка " + answer);
            }
        })
    })

});