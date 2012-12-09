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
		<div data-role="header" data-theme="a">
			<h1>
				Add Tag
			</h1>
		</div><!-- /header -->
		<div data-role="content">
			<h3>Enter a description and choose a category for your tag.</h3>
			<form>
				<label for="basic">Tag name:</label>
				<input type="text" name="name" id="basic" value=""  />

				<label for="select-choice-0" class="select">Category:</label>
				<select name="select-choice-0" id="select-choice-0">
					<option value="standard">Environment</option>
					<option value="rush">Management</option>
					<option value="express">Client</option>
				</select>

				<div class="ui-grid-a">
					<div class="ui-block-a">
						<a href="index.html" data-role="button" data-theme="e">Add tag</a>
					</div>
					<div class="ui-block-b">
						<a href="index.html" data-role="button">I changed my mind</a>
					</div>
				</div><!-- /grid-a -->
			</form>
		</div><!-- /content -->
	</div><!-- /page -->
</body>
</html>