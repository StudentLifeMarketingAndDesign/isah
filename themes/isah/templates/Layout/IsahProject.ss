<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>" role="main">
			$Breadcrumbs
			<h1>$Title</h1>
			

			<div class="row collapse">
				<div class="large-7 columns">
					<% include IsahProjectInfoCard %>
						<% if $Website %><p><a href="$Website" class="btn btn-small" target="_blank">Visit website &rarr;</a></p><% end_if %>
				</div>

				<div class="large-3 large-offset-2 columns">
					<p>Jump to county:</p>
					<ul>
						<% loop $Counties %>
							<li><a href="{$Top.Link}#{$URLSegment}">$Title</a></li>
						<% end_loop %>
					</ul>					
				</div>


			</div>
			
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
			<% include FeedbackLink %>

			<% include OtherDirectoryResources %>
		</section>
		<section class="sec-content hide-print">
			<% include DirectorySideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>