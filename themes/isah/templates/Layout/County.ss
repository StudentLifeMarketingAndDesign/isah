<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			<ul class="breadcrumbs">
				<li><a href="$Baseref">Home</a></li>
				<li><a href="directory/">Directory</a></li>
				<li><a href="directory/counties">Counties</a></li>
				<li><a href="$County.Link" class="active">$County.Title</a></li>
			</ul>
			<% with $County %>
			<h1>$Title County</h1>
			
	
		<% if $Project %>
				<% with $Project %>
					<h2><a href="$Link">$Title</a></h2>
					<% include IsahProjectInfoCard %>
				<% end_with %>
		<% end_if %>

		<h3>$Title County Resources:</h3>
				<div class="row resource-container collapse">
					<div class="large-12 columns">
						<ul class="large-block-grid-3 resource-list">
								<% loop $Resources %>
								
									<li><% include IsahResourceCard %></li>
								
								<% end_loop %>
						</ul>
					</div>
				</div>
	<% end_with %>
		</section>
		<section class="sec-content hide-print">
			<% include SideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>