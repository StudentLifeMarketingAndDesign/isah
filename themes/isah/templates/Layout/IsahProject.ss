<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
			$Breadcrumbs
			<h1>$Title</h1>
			
			<% if $Address %><p>$Address</p><% end_if %>

			<p>
				<strong>Service areas: </strong><% loop $Counties %><a href="$Link">$Title</a><%if not $Last %>, <% end_if %><% end_loop %><br />
				<% if $Website %><strong>Website: </strong><a href="$Website" target="_blank">Visit website &rarr;</a><br /><% end_if %>
				<% if $Email %><strong>Email address: </strong><a href="mailto:$Email">$Email</a><br /><% end_if %>
				<% if $LocalCrisisLine %><strong>Local crisis line: </strong>$LocalCrisisLine <br /><% end_if %>
				<% if $RegionalCrisisLine %><strong>Regional crisis line: </strong>$RegionalCrisisLine <br /><% end_if %>
				<% if $TwentyFourHourCrisisLine %><strong>24 hour crisis line: </strong>$TwentyFourHourCrisisLine <br /><% end_if %>
				<% if $SpanishLine %><strong>Spanish line: </strong>$SpanishLine <br /><% end_if %>
				<% if $OutreachOffices %><strong>Outreach offices: </strong>$OutreachOffices <br /><% end_if %>
				<% if $CrisisLines %><strong>Other crisis lines: </strong>$CrisisLines <br /><% end_if %>
				<% if $ServicesOffered %><strong>Services offered: </strong>$ServicesOffered <br /><% end_if %>

			</p>
			<h2>Counties serviced:</h2>
			<% loop $Counties %>
				<h3>$Title County</h3>
				<% loop $Categories %>
					<% include IsahCatCard %>
				<% end_loop %>
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