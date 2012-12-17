<% include SetupHeader %>
<div data-role="content">
	<h3>Your Team</h3>
	<% loop $CurrentMember.Team.Members %>
		<p>$Name</p>
	<% end_loop %>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<div class="buttons-left">
		<a href="team" data-role="button" data-iconpos="left" data-icon="arrow-l">Team</a>
	</div>
</div>