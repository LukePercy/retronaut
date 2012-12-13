<% include DiaryHeader %>
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
	<a href="$getLink('glads')" data-role="button" data-iconpos="right" data-icon="arrow-d">Daily Glads</a>
</div>
<% include DiaryVariables %>
<script type="text/javascript">
	var graphData = [
		<% loop $CurrentMember.getVertices() %>
			[$X, $InverseY]<% if not $Last %>,<% end_if %>
		<% end_loop %>
	];
</script>