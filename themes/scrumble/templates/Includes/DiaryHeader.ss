<div data-role="header" data-theme="a">
	<a href="." data-icon="home" data-iconpos="notext">Home</a>
	<h1>
		<span class="ui-icon ui-icon-scrumble-book"></span>
		$Title
	</h1>
</div><!-- /header -->
<div data-role="header" data-theme="e">
	<% if $getSprint.getPreviousDate %>
		<a href="$getLink(0, -1)" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left">Previous</a>
	<% end_if %>
	<h2>$Sprint.Day, Week $Sprint.Week</h2>
	<% if $getSprint.getNextDate %>
		<a href="$getLink(0, 1)" data-role="button" data-icon="arrow-r" data-iconpos="notext" class="ui-btn-right">Next</a>
	<% end_if %>
</div><!-- /header -->