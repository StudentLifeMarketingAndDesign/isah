<% if $County.Resources || $County.Project %>
	<% with $County %>
	<h2>Showing results for <a href="$Link">$Title County</a>:</h2>
	
		<% if $Project %>
			<p class="cat-name">Sexual Assault Project for $Title County</p>
				<% with $Project %>
					<h3><a href="$Link">$Title</a></h3>
					<% include IsahProjectInfoCard %>
				<% end_with %>
	
		<% end_if %>
			<h3>$Title County Resources:</h3>
			<% loop $Categories %>
				<% include IsahCatCard %>
			<% end_loop %>
	<% end_with %>
<% else %>
<p>No results found.</p>
<% end_if %>
<hr />