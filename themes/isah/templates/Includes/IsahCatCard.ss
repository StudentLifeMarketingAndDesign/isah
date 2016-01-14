				
				<div class="row collapse">
					<div class="large-12 columns">
						<h4 class="cat-name">$Title</h4>
						<ul class="large-block-grid-3">
							<% if $FilteredResources %>
								<% loop $FilteredResources %>
									<li><% include IsahResourceCard %></li>
								<% end_loop %>
							<% end_if %>
						</ul>
					</div>
				</div>