<% include RetroHeader %>
<div data-role="content">
	<h3>Discussion</h3>
	<p>These are the most pressing concerns facing the team. Discuss ways to reduce their impact in future.</p>
	<% loop $CurrentMember.Team.CurrentSprint.VotedCategories %>
		<p>
			<a class="category" id="category-$ID" data-role="button" data-inline="true" data-theme="b">$Name</a>
			<% control $TrendingTags %>
				$Name<% if not Last %>, <% end_if %>
			<% end_control %>
		</p>
	<% end_loop %>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<div class="buttons-left">
		<a href="retro/trends" data-role="button" data-iconpos="right" data-icon="arrow-u">Trends</a>
	</div>
	<div class="buttons-right">
		<!-- <a href="retro/actions" data-role="button" data-iconpos="right" data-icon="arrow-d">Actions</a> -->
		<a href="." data-role="button" data-iconpos="right" data-icon="arrow-d">Done</a>
	</div>
</div>