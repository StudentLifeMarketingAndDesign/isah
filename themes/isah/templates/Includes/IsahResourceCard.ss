<h4>$Title</h4>
<% if $FullAddressHTML %>$FullAddressHTML<% end_if %>
<p>
	<% if $Phone %><strong>Phone:</strong> $Phone <br /><% end_if %>
	<% if $Categories %> 
		Categories:
			<% if $Categories %>
				<% loop Categories %>
					<ul> <li> $Title </li></ul>
				<% end_loop %>
			<% end_if %>
	<% end_if %>
</p>