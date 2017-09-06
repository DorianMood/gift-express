function initRedactor() {
    console.log('initilise cropper');
    $('#image').cropper('destroy').cropper(CROPPER_OPTIONS);


    $("#select-polaroid-picture").unbind("click").on("click", function (e) {
         $("#upload-picture-input").trigger('click');
     });

    $("#refresh-polaroid").unbind("keyup").on('keyup', function (e) {
        refreshItemText();
        var text = $('#refresh-polaroid').val();
    });

    $("#upload-picture-input").unbind("change").change( function (e) {
        console.log('refreshing picture...');
        refreshItemPicture();
    });

    $("#add-to-cart-redactor").unbind("click").click( function (e) {
        //console.log(selected);
        //console.log(frames);
        //console.log(pictures);
        //console.log(text);
        
        var formData1 = new FormData();

        if (typeof($('.pillow-div').val()) !== 'undefined') {
            var number = $(this).parent().attr('number');
            var frame = $('#image').cropper('getData');
            var file = ($('#upload-picture-input')[0].files[0]);

            frames.set(9, frame);
            pictures.set(9, file);
            //console.log(pictures);
            frames.delete(0);
            pictures.delete(0);
        }

        if (typeof($('#product-gift').val()) !== 'undefined')
            makeGiftData();
        else if (typeof($('.pillow-div').val()) == 'undefined' && typeof($('plaid-div').val()) == 'undefined') {
            pictures = undefined;
            frames = undefined;
            text = undefined;
        }
        formData1 = createFormData(selected, pictures, frames, text);

        //console.log('form data');
        //console.log(formData1.getAll('itemId'));
        //console.log(formData1.getAll('itemPic[]'));
        //console.log(formData1.getAll('itemFrame[]'));
        //console.log(formData1.getAll('itemText'));
        upload(formData1);
    });
}
function refreshItemText() {
    var text = $('#refresh-polaroid').val();
    var element = $('.gift-text');
    if (text.length > 20) {
        alert("Будем лаконичными!");
        return;
    }
    element.empty().append(text);
}
function refreshItemPicture() {
    var crpInput = $("#upload-picture-input");
    var file = crpInput[0].files[0];
    $("#image").attr('src', URL.createObjectURL(file));
    $('#image').cropper('destroy').cropper(CROPPER_OPTIONS);
    crpInput.value = null;
}