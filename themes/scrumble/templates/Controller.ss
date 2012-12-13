<!DOCTYPE html>
<html>
<head>
	<% base_tag %>
	<title>$Title &raquo; $SiteConfig.Title</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	$MetaTags(false)
</head>
<body style="height: 100%; width: 100%; overflow: hidden;">
	<div data-role="page">
	<div data-role="header" data-theme="b">
		<img src="$ThemeDir/img/Retrologo.png" alt="Low resolution logo" style="margin: auto; display: block;" height="70"/>
	</div><!-- /siteheader -->
		$Layout
	</div><!-- /page -->
</body>
</html>