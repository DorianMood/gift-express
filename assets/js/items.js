$(document).ready( function () {
    $('.owl-carousel').on('click', '.button',  function (e) { // , .overlay, .text
        var div = $(e.target);

        if (div.attr('id') == 'carousel-item') {
            var id = div.children('div').attr('item_id');
            $('#upload-picture-input').val(null);
            $('#image').cropper('destroy');
            selectNewItem(id);
        }
    });
    $('.overlay').on('click', function (e) {
        $(e.target).parent().trigger('click');
    });

});
    
    function selectNewItem(id) {
        selected = id;
        $.ajax({
            method: "GET",
            url: "items/itemview?id=" + id,
            success: function (data) {
                var item = data;
                $('.product-content').html(data);
                
                //$('#image').cropper('destroy').cropper(CROPPER_OPTIONS);
                showFeedback(id);
            },
            error: function (data) {
                $(".product-content").empty().append('Error during refreshing...');
            }
        });
    }