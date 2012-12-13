<!DOCTYPE html>
<html>
<head>
	<% base_tag %>
	<title><% if MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	$MetaTags(false)
</head>
<body>
	<div data-role="page">
		<div data-role="header" data-theme="b">
			<h1>Retronaut</h1>
		</div><!-- /siteheader -->
		<div data-role="content">
			$Content
			<a href="diary" data-role="button" data-icon="ui-icon-scrumble-book" data-iconpos="right">Dev Diary</a>
			<a href="setup" data-role="button" data-icon="gear" data-iconpos="right">Setup</a>
			<a href="retrospective" data-role="button" data-icon="alert" data-iconpos="right">Retro Time!</a>
		</div><!-- /content -->
	</div><!-- /page -->
</body>
</html>