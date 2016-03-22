<ul class="event-calendar-quick-nav">
  <li><a href="$Link(today)"<% if CurrentAction(today) %> class="current"<% end_if %>><% _t('Calendar.QUICKNAVTODAY','Today') %></a></li>
  <li><a href="$Link(week)"<% if CurrentAction(week) %> class="current"<% end_if %>><% _t('Calendar.QUICKNAVWEEK','This week') %></a></li>
  <li><a href="$Link(month)"<% if CurrentAction(month) %> class="current"<% end_if %>><% _t('Calendar.QUICKNAVMONTH','This month') %></a></li>
  <li><a href="$Link(weekend)"<% if CurrentAction(weekend) %> class="current"<% end_if %>><% _t('Calendar.QUICKNAVWEEKEND','This weekend') %></a></li>
</ul>

