<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
	    <article class="main-content <% if $BackgroundImage %>margin-top<% end_if %>" role="main">
	    	$Breadcrumbs      
	    	<div class="event-calendar-controls">
			  $CalendarWidget
			  $MonthJumper
			  <% include QuickNav %>
			</div>
			<p><a href="$Parent.Link">&laquo; Back to $Parent.Title</a></p>
			<div class="vevent">
			  <h3 class="summary">$Title</h3>
			  <% with CurrentDate %>
			  <p class="dates">$DateRange<% if StartTime %> $TimeRange<% end_if %></p>
			  <p><a href="$ICSLink" title="<% _t('CalendarEvent.ADD','Add to Calendar') %>">Add this to Calendar</a></p>
			  <% end_with %>
			  $Content
			  <% if OtherDates %>
			  <div class="event-calendar-other-dates">
			    <h4><% _t('CalendarEvent.ADDITIONALDATES','Additional Dates for this Event') %></h4>
			    <ul>
			      <% loop OtherDates %>
			      <li><a href="$Link" title="$Event.Title">$DateRange<% if StartTime %> $TimeRange<% end_if %></a></li>  9
			      <% end_loop %> 
			    </ul>
			  </div> 
			  <% end_if %>
			</div>

	    </article>
	    <section class="sec-content hide-print">
	    	<% include SideNav %>
	    	
	    	<div class="event-calendar-controls">
			  $CalendarWidget
			  $MonthJumper
			  <% include QuickNav %>
			</div>

	    </section>
	</div>
</div>
<% include TopicsAndNews %> 

