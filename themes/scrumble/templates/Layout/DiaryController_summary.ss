<% include DiaryHeader %>
<div data-role="content">
	<h3>Diary Entry:</h3>
	<p>This is the diary entry for the day.</p>
	<h4>Glads</h4>
	<div id="glad-tags">
		<% loop $CurrentMember.getTags('Glad') %>
			<a id="tag-$ID" data-role="button" data-inline="true" data-theme="b" data-icon="delete">$Name</a>
		<% end_loop %>
	</div>
	<h4>Sads</h4>
	<div id="sad-tags">
		<% loop $CurrentMember.getTags('Sad') %>
			<a id="tag-$ID" data-role="button" data-inline="true" data-theme="b" data-icon="delete">$Name</a>
		<% end_loop %>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e">
	<a href="$getLink('sads')" data-transition="slidedown" data-role="button" data-iconpos="left" data-icon="arrow-u">Daily Sads</a>
	<!-- <a href="$getPostSummaryLink" data-role="button" data-iconpos="right" data-icon="arrow-d">?</a> -->
</div>