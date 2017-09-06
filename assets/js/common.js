var selected = 9;

var form = new FormData();

var CROPPER_OPTIONS = {
    aspectRatio: 1 / 1,
    zoomable: 0,
    preview: '.preview',
    crop: function(e) {
        form.set('itemX', parseInt(e.x));
        form.set('itemY', parseInt(e.y));
        form.set('itemW', parseInt(e.width));
        form.set('itemH', parseInt(e.height));
    }
};
var OWL_OPTIONS = {
    loop: false,
    nav: false,
    autoplay: true,
    autoplayHoverPause: true,
    smartSpeed: 1000,
    autoplayTimeout: 2000,
    responsive:{ //Адаптация
        0:{
            items: 1
        },
        600:{
            items: 2
        },
        1000:{
            items: 4
        }
    }
};

$(document).ready( function () {
    
    selected = $('.overlay').attr('item_id');
    cartInit();

    $(".owl-carousel").owlCarousel(OWL_OPTIONS);

    // для того чтобы не громоздило код в индексе (необходим для загрузки файлов)
    $("body").append("<form action='cart/add' id='upload-form' enctype='multipart/form-data' style='display: none;'>" +
        "<input name='itemPic' id='upload-picture-input' type='file' style='display: none;' />" +
        "</form>");

    // добавление в корзину
    $(document).on('click', '#cart-item-add', function () {
        formData1 = createFormData(selected);
        upload(formData1);
    });
    $("#cart-clear").click( function () {
        cartClear();
    });

});

function upload(formData) {
    uploadItem(formData);
}
function uploadItem(formData) {
    $.ajax({
        url: "cart/add",
        type: "POST",
        contentType: false,
        processData: false,
        data: formData,
        dataType: "json",
        success: function (data) {
            console.log('Successfully uploaded!');
            cartRefresh();
        },
        error: function (data) {
            console.log('Something goes bad : ' + JSON.parse(data));
        }
    })
}

function createFormData(itemId, pictures, frames, text) {
    var formData = new FormData();
    formData.append('itemId', parseInt(itemId));
    if (typeof(pictures) !== 'undefined' && pictures.size != 0) {
        console.log('Adding pictures to form...');
        for (var i = 1; i <= pictures.size; i++) {
            //console.log(pictures.get(i));
            //console.log(JSON.stringify(frames.get(i)));
            formData.append('itemPic[]', pictures.get(i));
            formData.append('itemFrame[]', JSON.stringify(frames.get(i)));
        }
    }
    if (typeof(text) !== 'undefined') {
        console.log('Adding text to form...');
        formData.append('itemText', text);
    }
    return formData;
}