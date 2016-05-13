<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Playligo</title>

    @yield('meta')

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Signika+Negative:400,300,600,700' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.css">
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/presets/preset1.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ elixir('css/app.css') }}" rel="stylesheet">
    @yield('style')
    <!-- <script src="//load.sumome.com/" data-sumo-site-id="12f06233c59661b6520eb33ff694b42a0caa863dcc1b7c72527912614ad97be2" async="async"></script> -->
</head>
<body>
  <div id="main-wrapper" class="homepage">
  <header id="navigation">
  			<div class="navbar" role="banner">
  				<div class="container">
  					<a class="secondary-logo" href="{{ url('/') }}">
  						<img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="logo">
  					</a>
  				</div>
  				<div class="topbar">
  					<div class="container">
  						<div id="topbar" class="navbar-header">
  							<a class="navbar-brand" href="{{ url('/') }}">
  								<img class="img-responsive" src="{{ asset('img/logo.png') }}" alt="logo">
  							</a>
  							<!-- <div id="topbar-right">
  								<div class="dropdown language-dropdown">
  									<a data-toggle="dropdown" href="#"><span class="change-text">En</span> <i class="fa fa-angle-down"></i></a>
  									<ul class="dropdown-menu language-change">
  										<li><a href="#">EN</a></li>
  										<li><a href="#">FR</a></li>
  										<li><a href="#">GR</a></li>
  										<li><a href="#">ES</a></li>
  									</ul>
  								</div>
  							</div> -->
  							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
  								<span class="sr-only">Toggle navigation</span>
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  								<span class="icon-bar"></span>
  							</button>
  						</div>
  					</div>
  				</div>
  				<div id="menubar" class="container">
  					<nav id="mainmenu" class="collapse navbar-collapse">
              <ul class="nav navbar-nav">
                  <li><a href="{{ url('/home') }}">Home</a></li>
                  <li><a href="{{ url('/search') }}"><i class="fa fa-search"></i> Search</a></li>
                  <li><a href="{{ url('/suggest_location') }}"><i class="fa fa-lightbulb-o"></i> Suggest</a></li>
              </ul>

              <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                  @if (Auth::guest())
                      <li><a href="{{ url('/login') }}">Login</a></li>
                      <li><a href="{{ url('/register') }}">Register</a></li>
                  @else
                      <li><a href="{{ url('/playlist') }}"><i class="fa fa-list"></i> My Playlists</a></li>
                      <li><a href="{{ url('/poll') }}"><i class="fa fa-bar-chart"></i> My Polls</a></li>
                      @if (auth()->user()->hasRole('admin'))
                      <li><a href="{{ url('/admin') }}"><i class="fa fa-gears"></i> Admin</a></li>
                      @endif
                      <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                              {{ Auth::user()->name }}
                              <!-- {{ Auth::user()->name }} <div class="media-photo media-round user-profile-image header-icon icon-profile-alt-white"><img width="24" height="24" src="{{ Auth::user()->avatar }}"></div> -->
                               <span class="caret"></span>
                          </a>

                          <ul class="dropdown-menu" role="menu">
                              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                          </ul>
                      </li>
                  @endif
              </ul>

  					</nav>
  				</div>
  			</div>
  		</header>
  <div class="container">
    @include('layouts.partials.messagebag')
  </div>
  @yield('content')
</div><!--/#main-wrapper-->
  <footer id="footer">
		<div class="footer-menu">
			<div class="container">
				<ul class="nav navbar-nav">
					<li><a href="#">Home</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Products</a></li>
					<li><a href="#">Career</a></li>
					<li><a href="#">Advertisement</a></li>
					<li><a href="#">Team</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
			</div>
		</div>
	<div class="footer-bottom">
		<div class="container text-center">
			<p><a href="#">Playligo </a>&copy; 2015 </p>
		</div>
	</div>
</footer>
    <!-- <footer class="footer">
      <div class="container">
        <p class="text-muted">Playligo.com {{ date('Y') }}</p>
      </div>
    </footer> -->
    @include('layouts.partials.modal')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('js/playligo-main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js')}}"></script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=266649633362050";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!--Start of Zopim Live Chat Script-->
    <script type="text/javascript">
    window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
    d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
    _.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
    $.src="//v2.zopim.com/?3tJY4ySCgNDah77yIJSnKlD2M8YviqKH";z.t=+new Date;$.
    type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
    </script>
    <!--End of Zopim Live Chat Script-->

    <!--Start of Google Analytics Script-->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-77339981-1', 'auto');
      ga('send', 'pageview');

    </script>
    <!--End of Google Analytics Script-->

    @yield('script')

</body>
</html>
