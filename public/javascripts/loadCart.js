function loadCartAjax() {
    $.ajax({
        url: "ajax/loadCart.php",
        type: 'POST',
        dataType: 'json',
        data: {
        },
        success: function (data) {
            var cart = document.getElementById("cart");
            var headerCart = document.getElementById("headerCart");
            cart.innerHTML = data.cart;
            headerCart.innerHTML = data.headerCart;
        },
        error: function (e) {
            console.log(e.message);
            throw e;
        }
    });
}