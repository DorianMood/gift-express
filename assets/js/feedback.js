$(document).ready( function () {
	showFeedback(selected);
});
function showFeedback(id) {
	$.ajax({
			method: "GET",
			url: "feedback?id=" + id,
		success: function (data) {
			var item = data;
			$('.review-block').html(data);
		},
		error: function (data) {
			$(".review-block").empty().append('Error during refreshing...');
		}
	});
}