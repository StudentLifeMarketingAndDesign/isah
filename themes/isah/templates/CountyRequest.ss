<% if $County %>
	<% with $County %>
	<p>Showing results for $Title County:</p>
		<% if $Project %>
			<article>
				<% with $Project %>
					<% include IsahProjectCard %>
				<% end_with %>
					<h2>Johnson County Resources:</h2>
			</article>
		<% end_if %>
		<% loop $Resources %>
			<% include IsahResourceCard %>
		<% end_loop %>

	<% end_with %>
<% else %>
<p>No results found.</p>
<% end_if %>