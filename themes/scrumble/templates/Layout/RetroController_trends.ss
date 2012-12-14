<% include RetroHeader %>
<div data-role="content">
	<h3>Trends</h3>
	<p>These are the issues that the team faced during the last sprint. Vote for those you feel are the most important.</p>
	<% control $CurrentMember.Team.CurrentSprint.TrendingCategories %>
		<p>
			<a class="category" id="category-$ID" data-role="button" data-inline="true" data-theme="b" data-icon="plus">$Name: <span class="num-votes">$NumVotes</span></a>
			<% control $TrendingTags %>
				$Name<% if not Last %>, <% end_if %>
			<% end_control %>
		</p>
	<% end_control %>
</div><!-- /content -->
<div data-role="footer" data-position="fixed" class="ui-bar stage-<% with CurrentMember %><% if $Team.AllVotesCommitted %>ready<% else_if $VotesCommitted %>committed<% else_if NumVotesLeft = 0 %>voted<% else %>voting<% end_if %><% end_with %>" data-theme="e" data-tap-toggle="false">
	<a href="retro" data-role="button" data-iconpos="right" data-icon="arrow-u">Mood Graph</a>
	<a id="reset-votes" href="#" data-role="button" data-iconpos="left" data-icon="delete">Reset votes</a>
	<a id="votes-left" href="#" data-role="button">Votes left: <span id="num-votes">$CurrentMember.NumVotesLeft</span></a>
	<a id="commit-votes" href="#" data-role="button" data-iconpos="left" data-icon="check">Commit votes</a>
	<a id="waiting" href="#" data-role="button">Waiting<span class="ellipsis-container"><span class="spacer">...</span><span class="content">.</span></span></a>
	<a id="next" href="retro/discuss" data-role="button" data-iconpos="right" data-icon="arrow-d">Discuss</a>
</div>
<script type="text/javascript">
	var sprintId = $CurrentMember.Team.CurrentSprint.ID;
	var maxNumVotes = $MaxNumVotes;
</script>