<a href="http://studentlife.uiowa.edu" class="hide-print footer-logo"><img src="division-project/images/dosl-uiowa.png" alt="Division Of Student Life"></a>
<% if $SiteConfig.GroupSummary %>
	$SiteConfig.GroupSummary
<% else %>
	<p>The Division of Student Life fosters student success by creating and promoting inclusive educationally purposeful services and activities within and beyond the classroom.</p>
<% end_if %>
<p>$SiteConfig.Address
	<% if $SiteConfig.PhoneNumber %>
		$SiteConfig.PhoneNumber <br />
	<% end_if %>
	<% if $SiteConfig.EmailAddress %>
		Email: <a href="mailto:{$SiteConfig.EmailAddress}">$SiteConfig.EmailAddress</a>
	<% end_if %>
</p>