<h2><a href="$Link">$Title</a></h2>
<p>
	<strong>Service areas: </strong><% loop $Counties %>$Title<%if not $Last %>, <% end_if %><% end_loop %><br />
	<% if $Website %><strong>Website: </strong><a href="$Website" target="_blank">Visit website &rarr;</a><br /><% end_if %>
	<% if $LocalCrisisLine %><strong>Local crisis line: </strong>$LocalCrisisLine <br /><% end_if %>
	<% if $RegionalCrisisLine %><strong>Regional crisis line: </strong>$RegionalCrisisLine <br /><% end_if %>
	<% if $Email %><strong>Email address: </strong><a href="mailto:$Email">$Email</a><br /><% end_if %>
	
</p>
<a href="$Link" class="btn btn-small">More info and services offered &rarr;</a>
<hr />

