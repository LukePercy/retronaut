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
	<h3>What went right today?</h3>
	<p>Choose the glads that best describe your sources of happiness today.</p>
	<div class="ui-grid-a">
		<div class="ui-block-a">
			<select id="tags" data-theme="e">
				<option value="">Glads</option>
				<% loop Categories %>
					<optgroup label="$Title">
						<% loop Tags %>
							<option value="tag-$ID">$Title</option>
						<% end_loop %>
					</optgroup>
				<% end_loop %>
			</select>
		</div>
<!--
		TODO: Add custom tags in.
		<div class="ui-block-b">
			<a href="diary/addtag?type=glad" data-role="button" data-inline="true" data-iconpos="notext" data-theme="f" data-icon="add">New</a>
		</div>
-->
	</div><!-- /grid-a -->
	<div id="chosen-tags">
		<% loop $CurrentMember.getTags('Glad') %>
			<a id="tag-$ID" data-role="button" data-inline="true" data-theme="b" data-icon="delete">$Name</a>
		<% end_loop %>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e">
	<a href="diary" data-transition="slidedown" data-role="button" data-iconpos="left" data-icon="arrow-u">Mood Graph</a>
	<a href="diary/sads" data-role="button" data-iconpos="right" data-icon="arrow-d">Daily Sads</a>
</div>
<script type="text/javascript">
	<% with $CurrentMember %>
		var memberId=$ID;
		<% with $Team.CurrentSprint %>
			var sprintId=$ID;
			var day=$DayIndex;
		<% end_with %>
	<% end_with %>
</script>