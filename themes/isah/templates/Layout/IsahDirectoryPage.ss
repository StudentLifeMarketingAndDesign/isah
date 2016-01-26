<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			$Breadcrumbs
			$Content
			<hr />
			<% include FeedbackLink %>
		</section>
		<section class="sec-content hide-print">
			<% include DirectorySideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>