    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container navAlignCenter navText">
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
            <li><a target="_blank" href="http://www.thaimtb.co.th/forum/viewforum.php?f=735">WEBBOARD</a></li>
          </ul>
          <form class="navbar-form navbar-right" role="search" action="search">
            <div class="form-group">
              <input type="text" name="keyword" class="form-control searchInput" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-md btnSearch">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </form>
        </div>
      </div>
    </nav>