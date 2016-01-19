<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			<ul class="breadcrumbs">
				<li><a href="$Baseref">Home</a></li>
				<li><a href="directory/">Directory</a></li>
				<li><a href="directory/counties">Counties</a></li>
				<li><a href="$County.Link" class="active">$County.Title</a></li>
			</ul>
			<% with $County %>
			<h1>$Title County</h1>
			
	
		<% if $Project %>
				<% with $Project %>
					<h2><a href="$Link">$Title</a></h2>
					<% include IsahProjectInfoCard %>
				<% end_with %>
					<p><a href="$Link" class="btn btn-small btn-primary">More information</a> <% if $Website %><a href="$Website" class="btn btn-small" target="_blank">Visit website &rarr;</a><% end_if %></p>
		<% end_if %>

		<h3>$Title County Resources:</h3>
			<% loop $Categories %>
				<% include IsahCatCard %>
			<% end_loop %>

	<% end_with %>
		</section>
		<section class="sec-content hide-print">
			<% include SideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>