<script type="text/javascript">
	<% with $CurrentMember %>
		var memberId=$ID;
		<% with $Team.CurrentSprint %>
			var sprintId=$ID;
			var day=$DayIndex;
		<% end_with %>
	<% end_with %>
</script>