
<% if $County %>

	<% with $County %>
	<p>Showing results for $Title County:</p>

	<article>
		<% with $Project %>
			<h1>$Title</h1>
			$Content
		<% end_with %>

		<% loop $Resources %>
			<h2>$Title</h2>
		<% end_loop %>

	<% end_with %>
	</article>
<% else %>
<p>No results found.</p>
<% end_if %>