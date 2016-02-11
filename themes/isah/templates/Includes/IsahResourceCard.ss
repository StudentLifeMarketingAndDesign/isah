<div class="county-resource" data-lat="$Lat" data-lng="$Lng" data-title="$Title" data-phone="$Phone" data-website="$Website" data-address="$Address, $Suburb, $State, $Postcode" data-cat="$Categories.First.Title">
<h5>$Title</h5>
<% if $FullAddressHTML %>$FullAddressHTML<% end_if %>
<% if $Phone %><p><strong>Phone:</strong> $Phone </p><% end_if %>
<% if $Website %><p><a href="$Website" class="btn btn-small" target="_blank">Visit Website &rarr;</a></p><% end_if %>
</div>

