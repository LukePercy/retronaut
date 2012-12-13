$(window).load(function(){
	$('#tags').change(function(){
		var chosenTag = $(this).find(':selected')
		var name = chosenTag.val();
		var tagList = $('#chosen-tags');
		if (tagList.find('#' + name).length == 0) {
			// Create and add the button for the just-added tag.
			var newTag = $('<a></a>')
				.attr('id', name)
				.attr('data-role', 'button')
				.attr('data-inline', 'true')
				.attr('data-theme', 'b')
				.attr('data-icon', 'delete')
				.text(chosenTag.text());
			tagList.append(newTag);
			newTag.button();

			// TODO: Remove the option from the select (and possibly the whole option group)

			// Make an ajax call to save the tag to the user, sprint and day.
			var tagParts = name.split('-');
			var tagId = tagParts[tagParts.length - 1];
			// TODO: Add progress indicator
			$.post(
				'tags/add',
				{
					tag: tagId,
					member: memberId,
					sprint: sprintId,
					day: day
				},
				function(data) {
					// TODO: Remove progress indicator.
				}
			);
		}		

		/* This isn't implemented yet, so hacking around it.
		$(this).val('').selectmenu('refresh'); */
		// begin hack //
		$(this).val('');
		$(this).closest('.ui-btn').find('.ui-btn-text').text($(this).find(':selected').text());
		// end hack //
	});

	$('#chosen-tags').on('click', 'a', function(event){
		var tagParts = $(this).attr('id').split('-');
		var tagId = tagParts[tagParts.length - 1];
		// TODO: Add progress indicator.
		$.post(
			'tags/remove',
			{
				tag: tagId,
				member: memberId,
				sprint: sprintId,
				day: day
			},
			function(data) {
				// TODO: Remove progress indicator.
			}
		);

		$(this).remove();
	});
});