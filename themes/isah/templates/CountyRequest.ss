<% if $County.Resources || $County.Project %>
	<% with $County %>
	<p><button class="btn" id="new-search-btn">Start a new search</button></p>
	<h2>Showing results for <a href="$Link">$Title County</a>:</h2>

		<% if $Project %>
			<div class="project">
				<p class="cat-name">Sexual Assault Project for $Title County</p>
				<% with $Project %>
					<h3><a href="$Link">$Title</a></h3>
					<% include IsahProjectInfoCard %>
					<p><a href="$Link" class="btn btn-small btn-primary">More information</a> <% if $Website %><a href="$Website" class="btn btn-small" target="_blank">Visit website &rarr;</a><% end_if %></p>
				<% end_with %>
				<% include NearbyProjectCenters %>
			</div>
		<% end_if %>
		<% if $Categories %>
			<h3>More $Title County Resources:</h3>
			<% loop $Categories %>
				<% include IsahCatCard %>
			<% end_loop %>
		<% end_if %>
	<% end_with %>
<% else %>
<h2>No results found for $County.Title County</h2>
<p> If you feel you've received this message in error, please click the feedback link at the bottom of this page.</p>
<% end_if %>
