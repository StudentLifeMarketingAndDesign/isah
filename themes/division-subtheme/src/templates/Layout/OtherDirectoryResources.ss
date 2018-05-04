        <% loop $OtherDirectoryResources %>
          <h3><a href="$Link">$MenuTitle</a></h3>
          <p>$Content.Summary(50) <a href="$Link">Continue reading</a></p>
        <% end_loop %>