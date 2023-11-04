function loadCartAjax() {
    $.ajax({
        url: "ajax/loadCart.php",
        type: 'POST',
        dataType: 'json',
        data: {
        },
        success: function (data) {
            var headerCart = document.getElementById("headerCart");
            headerCart.innerHTML = data.headerCart;
        },
        error: function (e) {
            console.log(e.message);
            throw e;
        }
    });
}