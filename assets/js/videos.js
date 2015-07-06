function formatSeconds(s) {
	
	var m = Math.floor(s / 60); //Get remaining minutes
	s -= m * 60;

	return (m < 10 ? '0'+m : m) + ":" + (s < 10 ? '0'+s : s);
}

$(document).ready(function() {
	
	$("#sort-list").on('click', 'li', function() {		
		$("#sort-display").text($(this).text());
		$("#sort-display").attr('data-sort', $(this).attr('data-sort'));
	});
	
	$("#cat-list").on('click', 'li', function() {		
		$("#cat-display").text($(this).text());
		$("#cat-display").attr('data-cat', $(this).attr('data-cat'));
	});
	
	$("#show-button").on('click', function() {
		
		$("#video-list").empty();
		
		$.ajax({
			url: 'videos',
			data: {
				sort: $("#sort-display").attr('data-sort'),
				category: $("#cat-display").attr('data-cat'),
				tag: $("#input-tag").val(),
				embed: $("#embed-check").prop('checked'),
				per_page: '10'
			},
			success: function(data, status) {
				$.each(JSON.parse(data), function() {
				
					$("#video-list").append("<h3><a href='" + this.link + "' target='_blank'>" + this.name + "</a></h3>");
					if (this.embed === '1') {
						$("#video-list").append('<div class="embed-responsive embed-responsive-16by9"><iframe class="embed-responsive-item" src="https://player.vimeo.com' + this.uri.replace('/videos', '/video') + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>');
					}
					$("#video-list").append("<p>Duration: " + formatSeconds(this.duration) + "</p>");
					if (this.plays) {
						$("#video-list").append("<p>Plays: " + this.plays.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "</p>");
					}
				
				});
			}
		})
		
	});

});