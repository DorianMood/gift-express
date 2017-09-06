var frames = new Map();
var pictures = new Map();

$('.pillow-preview-container').on('click', function (e) {
	var cell = $(e.target);

	var pastCell = $('.preview');
	var pastCellNumber = $(pastCell).parent().attr('number');
	pastCell.clone().appendTo($('.preview').parent());
	pastCell.hide();
	$('.pillow-preview-container').removeClass('preview');

	cell.addClass('preview');
	var amount = 0;
	$('.pillow-td').each( function () {
		var newNumber = $(this).attr('number');
		amount = newNumber > amount ? newNumber : amount;
	});


	
	console.log('initilize cropper');
	var number = $(this).parent().attr('number');
	var file = getFile($('.pillow-td[number=' + pastCellNumber + ']').children().last().children().first().attr('src'));

	file = ($('#upload-picture-input')[0].files[0]);

	var frame = $('#image').cropper('getData');
	frames.set(parseInt(number) - 1, frame);
	pictures.set(parseInt(number) - 1, file);
	$('#image').cropper('destroy').cropper(CROPPER_OPTIONS);
});

$('#clear-pillow-table').on('click', function() {
	var cells = $('.pillow-td');
	cells.each( function (index, element) {
		var container = $(this).children().first().detach();
		container.empty();
		container.removeAttr('style');
		container.removeClass('preview');
		$(this).empty();
		container.appendTo($(this));
	});
	frames = new Map();
	pictures = new Map();
});

function getFile(url) {
	var urlCreator = window.URL || window.webkitURL;
	var request = new XMLHttpRequest();
	request.open('GET', url, false);
	request.send();
	var type = request.getResponseHeader('Content-Type');
	var bytes = request.response;
	var blob = new Blob([bytes], {type: type});
    var imageUrl = urlCreator.createObjectURL(blob);
    console.log(URL.createObjectURL(blob));
	var extension = type.split('/')[type.split('/').length - 1];
	console.log(extension);
	var file = new File([blob], Math.random().toString(36).substring(7) + '.' + extension);
	return file;
}