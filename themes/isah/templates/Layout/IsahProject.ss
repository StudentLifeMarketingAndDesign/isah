<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			$Breadcrumbs
			<h1>$Title</h1>
			<% include IsahProjectInfoCard %>
			<h2>Counties serviced</h2>
			<p>Jump to:</p>
			<ul>
				<% loop $Counties %>
					<li><a href="{$Top.Link}#{$URLSegment}">$Title</a></li>
				<% end_loop %>
			</ul>
			<% loop $Counties %>
				<h2 id="$URLSegment">$Title County</h2>
				<% if $Resources %>
					<% loop $Categories %>
						<% include IsahCatCard %>
					<% end_loop %>
				<% end_if %>
			<hr />
			<% end_loop %>
			$Content
			$Form
		</section>
		<section class="sec-content hide-print">
			<% include SideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>