				<h4 class="cat-name">$Title</h4>
				<div class="row">
					<div class="large-12 columns">
						<ul class="large-block-grid-3">
							<% if $Resources %>
								<% loop $Resources %>
									<li><% include IsahResourceCard %></li>
								<% end_loop %>
							<% end_if %>
						</ul>
					</div>
				</div>