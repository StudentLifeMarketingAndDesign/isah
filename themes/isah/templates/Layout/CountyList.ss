<% include BackgroundImage %>
<div class="gradient">
	<div class="container clearfix">
		<div class="white-cover"></div>
		<section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>" role="main">
			<ul class="breadcrumbs">
				<li><a href="$Baseref">Home</a></li>
				<li><a href="directory/">Directory</a></li>
				<li><a href="directory/county/list" class="active">Counties</a></li>
			</ul>
			<h1>Resources By County</h1>

				<div class="row">
					<div class="medium-4 columns">
						<ul>
						<% loop $Counties.Limit(33,0) %>
							<li><a href="$Link">$Title</a></li>
						<% end_loop %>
						</ul>
					</div>
					<div class="medium-4 columns">
						<ul>
						<% loop $Counties.Limit(33,33) %>
							<li><a href="$Link">$Title</a></li>
						<% end_loop %>
						</ul>
					</div>
					<div class="medium-4 columns">
						<ul>
						<% loop $Counties.Limit(999,66) %>
							<li><a href="$Link">$Title</a></li>
						<% end_loop %>
						</ul>
					</div>
				</div>
			$Content
			$Form
			<hr />
			<% include FeedbackLink %>
		</section>
		<section class="sec-content hide-print">
			<% include DirectorySideNav %>
		</section>
	</div>
</div>
<% include TopicsAndNews %>