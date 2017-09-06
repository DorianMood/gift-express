$(document).ready( function () {
    $(document).on('click', '.order-delete', function (e) {
        var itemNumber = 0;
        var t = $(e.target);
        if (t.prop('tagName') == 'IMG')
            itemNumber = t.parent().parent().parent().attr('item-number');
        else
            itemNumber = t.parent().parent().attr('item-number');
        cartRemove(itemNumber);
        cartRefresh();
    });
    $(document).on('click', '#order-buy', function (e) {
        var description = $('#order-description').val();
        var name = $('#order-name').val();
        var phone = $('#order-phone').val();
        var email = $('#order-email').val();
        var address = $('#order-address').val();

        if (name.length && address.length && phone.length && email.length && description.length) {
            console.log(name + " " + address + " " + phone + " " + email + " " + description);
            cartBuy(name, address, phone, email, description);
        }
    });
});

// TODO : slideToggle() для итемов

// обновление блока корзины
function cartRefresh(data) {
    console.log('refreshing');
    $.ajax({
        method: "GET",
        url: "cart/get",
        success: function (data) { $('.order').empty().append(data); },
        error: function (data) {
            alert('error');
            $(".cart-items").empty().append('Error during refreshing...');
        }
    });
}
// удаление товара из корзины
function cartRemove(id) {
    $.ajax({
        method: 'GET',
        url: 'cart/remove?itemNumber=' + id,
        success: function (data) {
            console.log('deleted')
        },
        error: function (data) {
            alert('delete error');
        }
    });
    cartRefresh();
}
// полная чистка корзины
function cartClear() {
    $.ajax({
        method: "GET",
        url: "cart/clear",
        success: function (data) {
            $(".cart-items").empty().append(JSON.parse(data));
        },
        error: function (data) {
            $(".cart-items").empty().append(JSON.parse(data));
        }
    });
}
// инициализация корзины
function cartInit() {
    $.ajax({
        method: "GET",
        url: "cart",
        success: function (data) {
            cartRefresh(data);
        },
        error: function (data) {
            cartRefresh(data);
        }
    });
}
// отправка всего заказа
function cartBuy(name, address, phone, email, description) {
    $.ajax({
        method: "GET",
        url: "cart/buy?name=" + name + "&address=" + address + "&phone=" + phone + "&email=" + email + "&description=" + description,
        success: function (data) {
            cartClear();
        },
        error: function (data) {
            alert('error');
        }
    });
}