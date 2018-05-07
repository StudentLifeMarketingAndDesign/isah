$Header
<main class="main-content__container" id="main-content__container">
	
	<% if $BackgroundImage %>
		<% include FeaturedImage %>
	<% end_if %>
	$Breadcrumbs
	<% if not $BackgroundImage %>
	<div class="column row">
		<div class="main-content__header">
			<h1>$Title</h1>
		</div>
	</div>
	<% end_if %>

	$BlockArea(BeforeContent)

	<div class="row">
		<article role="main" class="main-content main-content--with-padding <% if $Children || $Menu(2) || $SidebarBlocks ||  $SidebarView.Widgets %>main-content--with-sidebar<% end_if %>">

			$BlockArea(BeforeContentConstrained)

			<div class="main-content__text">
				<div class="locallistevent">
					<% if $CurrentDate %>
					  <% with CurrentDate %>
					  <p><strong>Date: </strong>$DateRange<% if AllDay %> <% _t('Calendar.ALLDAY','All Day') %><% else %><% if StartTime %> $TimeRange<% end_if %><% end_if %></p>
					  <p><a href="$ICSLink" class="button"><% _t('CalendarEvent.ADD','Add this to Calendar') %></a></p>
					  <% end_with %>
					<% end_if %>
						<% if $Location %>
							<p><strong>Location:</strong><br />$Location
							</p>
						<% end_if %>
						  <% if OtherDates %>
						  <div class="event-calendar-other-dates">
							<h5 class="event-title">All Dates</h5>
						    <ul>
						      <% loop OtherDates %>
						      <li><a href="$Link" title="$Event.Title">$DateRange<% if AllDay %> <% _t('Calendar.ALLDAY','All Day') %><% else %><% if StartTime %> $TimeRange<% end_if %><% end_if %></a></li>
						      <% end_loop %> 
						    </ul>
						  </div>
						  <% end_if %>
					<%-- Content --%>
					<% if $Content %>
						$Content
					<% end_if %>
				</div>
			</div>
		</article>
		<aside class="sidebar" class="dp-sticky">
			<div class="locallistevent__sidebar">
				<% if $Location %>
					<p><strong>Venue:</strong><br />$Location
					</p>
				<% end_if %>
			</div>

		</aside>
	</div>
</main>
