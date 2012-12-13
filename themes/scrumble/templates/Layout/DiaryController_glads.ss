<% include DiaryHeader %>
<div data-role="content">
	<h3>What went right today?</h3>
	<p>Choose the glads that best describe your sources of happiness today.</p>
	<div class="ui-grid-a">
		<div class="ui-block-a">
			<select id="tags" data-theme="e">
				<option value="">Glads</option>
				<% loop $Categories(Glad) %>
					<optgroup label="$Title">
						<% loop $Tags %>
							<% if $Type == Glad %>
								<option value="tag-$ID">$Title</option>
							<% end_if %>
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
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<a href="$getLink('index')" data-transition="slidedown" data-role="button" data-iconpos="left" data-icon="arrow-u">Mood Graph</a>
	<a href="$getLink('sads')" data-role="button" data-iconpos="right" data-icon="arrow-d">Daily Sads</a>
</div>
<% include DiaryVariables %>