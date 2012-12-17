<% include SetupHeader %>
<div data-role="content">
	<h3>Current Sprint</h3>
	<% with $CurrentMember.Team.CurrentSprint %>
		<p><strong>Sprint Number:</strong> $Number</p>
		<p><strong>Start Date:</strong> $StartDate.Format(l), $StartDate.Format(jS F Y)</p>
		<p><strong>End Date:</strong> $EndDate.Format(l), $EndDate.Format(jS F Y)</p>
	<% end_with %>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar" data-theme="e" data-tap-toggle="false">
	<div class="buttons-left">
		<a href="team" data-role="button" data-iconpos="left" data-icon="arrow-l">Team</a>
	</div>
</div>