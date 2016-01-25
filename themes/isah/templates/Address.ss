<address>
	$Address<br>
	<% if $Suburb || $State || $Postcode %>
	{$Suburb}, $State $Postcode<br>
	<% end_if %>
	$CountryName
</address>