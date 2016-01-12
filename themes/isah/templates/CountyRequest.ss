<% if $County.Resources || $County.Project %>
	<% with $County %>
	<p>Showing results for $Title County:</p>
	
		<% if $Project %>
			<article>
				<% with $Project %>
					<% include IsahProjectCard %>
				<% end_with %>
			</article>
		<% end_if %>
				<div class="row">
					<div class="large-12 columns">
						<ul class="large-block-grid-3">
								<% loop $Resources %>
								
									<li><% include IsahResourceCard %></li>
								
								<% end_loop %>
						</ul>
					</div>
				</div>
	<% end_with %>
<% else %>
<p>No results found.</p>
<% end_if %>