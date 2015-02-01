    <header>
        <div id="header-outer">
            <div id="header-inner" class="center text-center">
                <h1>Twitter Express</h1>
            </div>
        </div>
    </header>
<!--Main Content-->
<!--User will be prompt to enter in a string-->
    <div class="row">
        <div class="row">
            <div class="input-field col s6 offset-s3 text-center">
                <input id="searchinput" type="text">
                <a id="refresh-btn" class="waves-effect waves-light btn">Refresh Tweets</a>
                <label for="searchinput">Search</label>
            </div>
        </div>
    </div>
    <div class="row col s12">
      <div id="search-div" class="card col s12 l3">
        <div class="card-content">
          <p><b>Previous Searches</b></p>
          <ul id="old-searches"></ul>
        </div>
      </div>
      <div id="tweets" class="col s12 l9"></div>
    </div>
<!-- BEGIN: Underscore Template Definition. -->
    <script type="text/template" class="template">
        <div class="one-tweet col s12 l6">
          <div class="card white">
            <div class="card-content grey-text">
              <div class="col s2"><img class="circle" src=<%- rc.profile_image %>></div>
              <div class="col s10">
                <div class="col s12 username"><b id="special"><%= rc.user_name %></b></div>
                <div class="col s12 text"><%= rc.tweet_text %></div>
                <div class="col s12 createDate"> <%- rc.create_date %></div>
              </div>
            </div>
          </div>
        </div>
    </script>
    <!-- BEGIN: Underscore Template for Searches -->
    <script type="text/template" id="searchtemplate">
    <li><%- rc.search %></li>
    </script>
</div>