$(window).onload(function(){
	$('#tags').onchange(){
		var chosenTag = $(this).find(':selected')
		var name = chosenTag.attr('name');
		var tagList = $('#chosen-tags');
		if (tagList.find('#' + name).length == 0) {
			var newTag = $('<a></a>')
				.attribute('id', name)
				.attribute('data-role', 'button')
				.attribute('data-inline', 'true')
				.attribute('data-theme', 'b')
				.text(chosenTag.text());
			tagList.append(newTag);

			// Make an ajax call to save the tag to the user, sprint and day.
			var tagParts = name.split('-');
			var tagId = tagParts[tagParts.length - 1];
			$.post('/tags/save?tag=' + tagId + '&member=' + memberId + '&sprint=' + sprintId + '&day=' + day);
		}
	}
})