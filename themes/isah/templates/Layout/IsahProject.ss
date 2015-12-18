<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			$Breadcrumbs
			<h1>$Title</h1>
			<p>
				<strong>Service areas: </strong><% loop $Counties %>$Title<%if not $Last %>, <% end_if %><% end_loop %><br />
				<% if $Website %><strong>Website: </strong><a href="$Website" target="_blank">Visit website &rarr;</a><br /><% end_if %>
				<% if $Email %><strong>Email address: </strong><a href="mailto:$Email">$Email</a><br /><% end_if %>
				<% if $LocalCrisisLine %><strong>Local crisis line: </strong>$LocalCrisisLine <br /><% end_if %>
				<% if $RegionalCrisisLine %><strong>Regional crisis line: </strong>$RegionalCrisisLine <br /><% end_if %>
				<% if $TwentyFourHourCrisisLine %><strong>24 hour crisis line: </strong>$TwentyFourHourCrisisLine <br /><% end_if %>
				<% if $SpanishLine %><strong>Spanish line: </strong>$SpanishLine <br /><% end_if %>
				<% if $OutreachOffices %><strong>Outreach offices: </strong>$OutreachOffices <br /><% end_if %>

			</p>
			<% loop $Counties %>
				<% if $Resources %>
					<h3 class="county-name">$Title County</h3>
					<% loop $Resources %>
						<% include IsahResourceCard %>
					<% end_loop %>
				<% end_if %>
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