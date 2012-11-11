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
		<div data-role="header" data-theme="e">
			<h1>$Title</h1>
		</div><!-- /header -->
		<div data-role="content">
			$Layout
		</div><!-- /content -->
	</div><!-- /page -->
</body>
</html>