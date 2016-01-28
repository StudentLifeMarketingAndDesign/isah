 <% if Menu(2) %>
	<% with Level(1) %>
		<h3 class="section-title"><% if $LinkOrCurrent = "current" %>$MenuTitle<% else %><a href="$Link">$MenuTitle</a><% end_if %></h3>
	<% end_with %>
<% end_if %>

<% if Menu(2) %>
<nav class="sec-nav">
	<ul class="first-level">
			<% with Level(1) %>
				<li <% if $LinkOrCurrent = "current" && $Up.Action == "index" %>class="active"<% end_if %>><a href="<% if $regularLink %>$regularLink<% else %>$Link<% end_if %>">$MenuTitle</a></li>
					<ul class="second-level">
						<li <% if $Up.Action == "list" %>class="active"<% end_if %>><a href="directory/county/list" >By county</a></li>
					</ul>
			<% end_with %>
			<% loop OtherDirectoryResources %>
				<li <% if $LinkOrCurrent = "current" %>class="active"<% end_if %>>
				<a href="<% if $regularLink %>$regularLink<% else %>$Link<% end_if %>">$MenuTitle</a>
				</li>

			<% end_loop %>

			<li><a href="directory/">Sexual Assault Projects</a>
				<ul class="second-level">
					<% loop IsahProjects %>
						<li <% if $LinkOrCurrent = "current" %>class="active"<% end_if %>>
						<a href="<% if $regularLink %>$regularLink<% else %>$Link<% end_if %>">$MenuTitle</a>
						
						<%-- third level nav option 1 --%>
							<% if $LinkOrSection = "section" && Children %>
								<ul class="second-level">
									<% loop Children %>
										<li <% if $LinkOrCurrent = "current" %>class="active"<% end_if %>>
											<a href="<% if $regularLink %>$regularLink<% else %>$Link<% end_if %>">$MenuTitle</a>
											<% if $LinkOrSection = "section" && Children %>
												<ul class="third-level">
													<% loop Children %>
														<li <% if $LinkOrCurrent = "current" %>class="active"<% end_if %>>
															<a href="<% if $regularLink %>$regularLink<% else %>$Link<% end_if %>">$MenuTitle</a>
														</li>
													<% end_loop %>
												</ul>
											<% end_if %>

										</li>
									<% end_loop %>
								</ul>
							<% end_if %>
							
						<%-- end third level nav option 1 --%>
						
						</li>
					<% end_loop %>
				</ul>
			</li>
		
	</ul>
</nav>
<% end_if %>

<aside>
	<div class="mod">
		$SideBarView
	</div>
	<% if getSidebarItems %>
		<% loop getSidebarItems %>
			<% include SidebarItem %>
		<% end_loop %>
	<% end_if %>
</aside>