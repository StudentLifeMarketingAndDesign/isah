<% if $County.Resources || $County.Project %>
	<% with $County %>
	<h2>Showing results for <a href="$Link">$Title County</a>:</h2>
	
		<% if $Project %>
			<h3 class="cat-name">Sexual Assault Project for $Title County</h3>
				<% with $Project %>
					<h3><a href="$Link">$Title</a></h3>
					<% include IsahProjectInfoCard %>
					<p><a href="$Link" class="btn btn-small btn-primary">More information</a> <% if $Website %><a href="$Website" class="btn btn-small" target="_blank">Visit website &rarr;</a><% end_if %></p>
				<% end_with %>
	
		<% end_if %>
			<h3>More $Title County Resources:</h3>
			<% loop $Categories %>
				<% include IsahCatCard %>
			<% end_loop %>
	<% end_with %>
<% else %>
<p>No results found.</p>
<% end_if %>
<hr />