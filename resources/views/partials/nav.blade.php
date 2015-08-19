    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container navAlignCenter">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home"><img class="logo" src="images/khcycle_logo.png"/></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{ \App\Http\Utils::setActive('home') }}"><a href="home">HOME</a></li>
            <li class="{{ \App\Http\Utils::setActive('product') }}"><a href="product">PRODUCT</a></li>
            <li class="{{ \App\Http\Utils::setActive('news') }}"><a href="news">NEWS/ARTICLES</a></li>
            <li class="{{ \App\Http\Utils::setActive('contact') }}"><a href="contact">CONTACT</a></li>
            <li class="{{ \App\Http\Utils::setActive('member') }}"><a href="member">MEMBER</a></li>
            <li><a target="_blank" href="http://www.thaimtb.co.th/forum/index.php">WEBBOARD</a></li>
          </ul>

<!--           <div class="col-sm-3 col-md-3 pull-right">
            <form class="navbar-form" role="search">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                  <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
              </div>
            </form>
          </div> -->
        </div><!--/.nav-collapse -->
      </div>
    </nav>