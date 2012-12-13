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
	<!-- <a href="$getPostSummaryLink" data-role="button" data-iconpos="right" data-icon="arrow-d">?</a> -->
</div>
<script type="text/javascript">
	var graphData = [
		<% loop $CurrentMember.getVertices() %>
			[$X, $InverseY]<% if not $Last %>,<% end_if %>
		<% end_loop %>
	];
	var interactive = false;
</script>