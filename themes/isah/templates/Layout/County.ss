<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			$Breadcrumbs
			<% with $County %>
			<h1>$Title County</h1>
			
	
		<% if $Project %>
			<article>
				<% with $Project %>
					<% include IsahProjectCard %>
				<% end_with %>
			</article>
		<% end_if %>

		<h3>$Title County Resources:</h3>
			<% loop $Categories %>
				<% include IsahCatCard %>
			<% end_loop %>
	<% end_with %>
		</section>
		<section class="sec-content hide-print">
			<% include SideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>