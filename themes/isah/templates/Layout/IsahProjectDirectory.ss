<% include BackgroundImage %>
<div class="gradient">
  <div class="container clearfix">
    <div class="white-cover"></div>
      <section class="main-content <% if $BackgroundImage %>margin-top<% end_if %>">
        $Breadcrumbs

        <h1>Directory</h1>
        <p>Click "use my location" or choose a county below to find resources near you. Your location information is not stored or tracked by us.</p>
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

    <div id="mapholder"></div>

      <p id="demo"></p>
             <!-- <span id="County">Click on "Get County" or select a County </span> -->

    
          <hr />
        <div id="results">

        </div>
        Is this information accurate? <% include FeedbackModal %>

      </section>
      <section class="sec-content hide-print">
        <% include SideNav %>
      </section>

  </div>
</div>
<% include TopicsAndNews %> 




<%-- 41.663475,-91.5378082 --%>
<script src="//maps.google.com/maps/api/js?sensor=true"></script>