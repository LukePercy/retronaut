<% include DiaryHeader %>
<div data-role="content">
	<h3>What went right today?</h3>
	<p>Choose the sads that capture what you feel could have gone better today.</p>
	<div class="ui-grid-a">
		<div class="ui-block-a">
			<select id="tags" data-theme="e">
				<option value="">Sads</option>
				<% loop $Categories(Sad) %>
					<optgroup label="$Title">
						<% loop $Tags %>
							<% if $Type == Sad %>
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
			<a href="diary/addtag?type=sad" data-role="button" data-inline="true" data-iconpos="notext" data-theme="f" data-icon="add">New</a>
		</div>
-->
	</div><!-- /grid-a -->
	<div id="chosen-tags">
		<% loop $CurrentMember.getTags('Sad') %>
			<a id="tag-$ID" data-role="button" data-inline="true" data-theme="b" data-icon="delete">$Name</a>
		<% end_loop %>
	</div>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e">
	<a href="$getLink('glads')" data-transition="slidedown" data-role="button" data-iconpos="left" data-icon="arrow-u">Daily Glads</a>
	<a href="$getLink('summary')" data-role="button" data-iconpos="right" data-icon="arrow-d">Summary</a>
</div>
<% include DiaryVariables %>