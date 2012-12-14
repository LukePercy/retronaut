<% include DiaryHeader %>
<div data-role="content">
	<h3>Summary</h3>
	<p>This is your mood so far through the sprint:</p>
	<div id="mood-graph">
		<div id="graph">
		</div>
		<canvas id="sketchpad">
			Sorry, your browser doesn't support canvas technology.
		</canvas>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<a href="$getLink('sads')" data-transition="slidedown" data-role="button" data-iconpos="left" data-icon="arrow-u">Daily Sads</a>
	<% if $CurrentMember.Team.CurrentSprint.IsRetroDay %>
		<a href="retro" data-role="button" data-iconpos="right" data-icon="arrow-d">Retro Time!</a>
	<% else_if $CurrentMember.Team.CurrentSprint.NextDate %>
		<a href="$getLink('index', +1)" data-role="button" data-iconpos="right" data-icon="arrow-r">Next Day</a>
	<% else %>
		<a href="." data-role="button" data-iconpos="right" data-icon="arrow-d">Done</a>
	<% end_if %>
</div>
<script type="text/javascript">
	var graphData = [
		<% loop $CurrentMember.getGraphDataForSprint() %>
			[$X, $Y]<% if not $Last %>,<% end_if %>
		<% end_loop %>
	];
	var interactive = false;
</script>