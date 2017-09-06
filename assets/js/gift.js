var pictures = new Map();
var frames = new Map();
var text = undefined;

function makeGiftData() {
	text = $('#refresh-polaroid').val();
	pictures = new Map(); pictures.set(1, $('#upload-picture-input')[0].files[0]);
	frames = new Map(); frames.set(1, $('#image').cropper('getData'));
}