<% if $County %>
	<% with $County %>
	<p>Showing results for $Title County:</p>
	
		<% if $Project %>
			<article>
				<% with $Project %>
					<% include IsahProjectCard %>
				<% end_with %>
			</article>
		<% end_if %>

		<h3>$Title County Resources:</h3>
		<% loop $Resources %>
			<% include IsahResourceCard %>
		<% end_loop %>

	<% end_with %>
<% else %>
<p>No results found.</p>
<% end_if %>