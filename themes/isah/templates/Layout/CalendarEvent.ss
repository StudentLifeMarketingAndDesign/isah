<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
	    <article class="main-content <% if $BackgroundImage %>margin-top<% end_if %>" role="main">
	    	
			<p><a href="$Parent.Link">&laquo; Back to $Parent.Title</a></p>
			<div class="vevent">
			  <% if $Image %>
			    
			      <img src="$Image.ScaleWidth(800).URL" id="event-photo">
			   
			  <% end_if %> 
			  <h2 class="summary">$Title</h2>

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
			      <li><a href="$Link" title="$Event.Title">$DateRange<% if StartTime %> $TimeRange<% end_if %></a></li>
			      <% end_loop %> 
			    </ul>
			  </div>
			  <% end_if %>
			</div>
			

	    </article>
	    <section class="sec-content hide-print">

	    	<div class="event-calendar-controls">
			  $CalendarWidget
			  
			</div>
	    	<% include SideNav %>

	    	

	    </section>
	</div>
</div>
<% include TopicsAndNews %> 


