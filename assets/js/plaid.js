$('input[type=radio][name=orientation]').change( function () {
    if (this.value === 'vertical') {
        $('.plaid-table-horizontal').toggle('fast', function () {
            $('.plaid-table-vertical').toggle('fast');
        });
    } else {
        $('.plaid-table-vertical').toggle('fast', function () {
            $('.plaid-table-horizontal').toggle('fast');
        });
    }
});

$('#clear-plaid-table').on('click', function () {
    var cells = $('.plaid-td');
    cells.each( function (index, element) {
        var container = $(this).children().first().detach();
        container.empty();
        container.removeAttr('style');
        container.removeClass('preview');
        $(this).empty();
        container.appendTo($(this));
    });
});
$('.plaid-td').on('click', function (e) {
    var cell = $(e.target);

    var pastCell = $('.preview');
    pastCell.clone().appendTo($('.preview').parent());
    pastCell.hide();
    $('.plaid-preview-container').removeClass('preview');

    var amount = 0;
    $('.plaid-td').each( function () {
        var newNumber = $(this).attr('number');
        amount = newNumber > amount ? newNumber : amount;
    });
    var number = $(this).attr('number');
    var data = $('#image').cropper('getData');
    saveDB(number, data.x, data.y, data.height, data.width);

    cell.addClass('preview');
    $('#image').cropper('destroy').cropper(CROPPER_OPTIONS);
});
//$('td class='plaid-td'').on('click', function () {
//    uploadPlaidPic($(this));
//});    // plaid section
function uploadPlaidPic(cell) {
    var number = cell.text();
    var height = cell.height();
    cell.css('max-height', height);
    cell.empty().append('<div class=\'cell-preview preview\' style=\'height:' + height + 'px ;\'></div>');
    $('#image').cropper('destroy').cropper(CROPPER_OPTIONS);
    cell.height(height);
    console.log(number);
}