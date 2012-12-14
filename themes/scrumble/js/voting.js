$(window).load(function(){
	$('a.category').click(function(){
		var numVotesRemainingContainer = $('span#num-votes');
		var numVotesRemaining = numVotesRemainingContainer.text();
		if (numVotesRemaining <= 0) {
			return;
		}

		var categoryParts = $(this).attr('id').split('-');
		var categoryId = categoryParts[categoryParts.length - 1];

		var numVotesContainer = $(this).find('span.num-votes');
		var numVotes = parseInt(numVotesContainer.text()) + 1;

		// TODO: Add progress indicator.
		$.post(
			'votes/set',
			{
				sprint: sprintId,
				category: categoryId,
				votes: numVotes
			},
			function(data) {
				// TODO: Remove progress indicator.
			}
		);

		numVotesContainer.text(numVotes);

		numVotesRemaining--;
		numVotesRemainingContainer.text(numVotesRemaining);
		if (numVotesRemaining <= 0) {
			$('.ui-footer').removeClass('stage-voting').addClass('stage-voted');
		}
	});

	$('#reset-votes').click(function(){
		// TODO: Add progress indicator.
		$.post(
			'votes/clear',
			{
				sprint: sprintId
			},
			function(data) {
				// TODO: Remove progress indicator.
			}
		);

		$('a.category span.num-votes').text('0');
		$(this).closest('.ui-footer').removeClass('stage-voted').addClass('stage-voting');
		$('span#num-votes').text(maxNumVotes);
	});

	$('#commit-votes').click(function(){
		$.post(
			'votes/commit',
			{
				sprint: sprintId
			},
			function(data) {
				// TODO: Remove progress indicator.
			}
		);

		$(this).closest('.ui-footer').removeClass('stage-voted').addClass('stage-committed');
	});

	setInterval(function(){
		$('.ellipsis-container:visible .content').each(function(){
			var text = $(this).text();
			text += '.';
			if (text.length > 3) {
				text = '.';
			}
			$(this).text(text);
		});
	}, 500);

	setInterval(function(){
		if ($('.ui-footer').is('.stage-committed')) {
			$.post(
				'votes/AllVotesCommitted',
				{
					sprint: sprintId
				},
				function(data) {
					if (data == '1') {
						$('.ui-footer').removeClass('stage-committed').addClass('stage-ready');
					}
				}
			);
		}
	}, 10000);
});