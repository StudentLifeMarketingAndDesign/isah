<% include BackgroundImage %>
<div class="gradient">
  <div class="container clearfix">
    <div class="white-cover"></div>
      <section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
        $Breadcrumbs
        <% if FeedbackSuccess %>
          <p><strong>Thanks for submitting feedback to us, we've received your message.</strong></p>
        <% end_if %>
        <h1>Directory</h1>
        <div id="directory-form">
        $Content
          <div class="row small-collapse">
            <div class="large-3 columns">
              <p><button class="btn btn-large btn-primary" id="get-location">Use my location</button></p>
            </div>
            <div class="large-1 columns">
              <p class="or-padding">Or...</p>
            </div>
            <div class="large-8 columns">
                $CountyForm

            </div>
          </div>
            <p>If you're having trouble using the form above, <a href="directory/county/list">view a list of resources by county &rarr;</a></p>
          <!--<div id="mapholder"></div> -->

          <p id="geo-message" style="display: none;"></p>
          <hr />
        </div>
          <div id="loading" style="display:none;">
            <h2>Loading results...</h2>
            <img src="{$ThemeDir}/images/ajax-loader.gif" />
          </div>
        <div id="results" style="display:none;">

        </div>
        <% include OtherDirectoryResources %>
        <hr />
        <% include FeedbackLink %>

      </section>
      <section class="sec-content hide-print">
        <% include DirectorySideNav %>
      </section>

  </div>
</div>
<% include TopicsAndNews %> 

<%-- 41.663475,-91.5378082 --%>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>

