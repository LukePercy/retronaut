<% include RetroHeader %>
<div data-role="content">
	<h3>Mood Graph</h3>
	<p>This was the general mood throughout the sprint:</p>
	<div id="mood-graph">
		<div id="graph">
		</div>
		<canvas id="sketchpad">
			Sorry, your browser doesn't support canvas technology.
		</canvas>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<a href="retro/trends" data-role="button" data-iconpos="right" data-icon="arrow-d">Trends</a>
</div>
<script type="text/javascript">
	var graphData = [
		<% loop $CurrentMember.Team.Members %>
			[
				<% loop $GraphDataForSprint %>
					[$X, $Y]<% if not $Last %>,<% end_if %>
				<% end_loop %>
			]<% if not $Last %>,<% end_if %>
		<% end_loop %>
	];
	var interactive = false;
</script>
