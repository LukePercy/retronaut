<div data-role="header" data-theme="a">
	<a href="" data-icon="home" data-iconpos="notext">Home</a>
	<h1>
		<span class="ui-icon ui-icon-scrumble-book"></span>
		$Title
	</h1>
</div><!-- /header -->
<div data-role="header" data-theme="e">
	<% if $PreviousLink %>
		<a href="$PreviousLink" data-role="button" data-icon="arrow-l" data-iconpos="notext" class="ui-btn-left">Previous</a>
	<% end_if %>
	<h2>$Sprint.Day, Week $Sprint.Week</h2>
	<% if $NextLink %>
		<a href="$NextLink" data-role="button" data-icon="arrow-r" data-iconpos="notext" class="ui-btn-right">Next</a>
	<% end_if %>
</div><!-- /header -->
<div data-role="content">
	<h3>How did I feel today?</h3>
	<p>Sketch your mood throughout the day on the graph:</p>
	<div id="mood-graph">
		<div id="graph">
		</div>
		<canvas id="sketchpad">
			Sorry, your browser doesn't support canvas technology.
		</canvas>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e">
	<a href="diary/glads" data-role="button" data-iconpos="right" data-icon="arrow-d">Daily Glads</a>
</div>