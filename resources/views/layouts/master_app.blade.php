<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts.partials.meta')
    @yield('meta')
    <title>{{ $page_title or config('playligo.title') }}</title>

    <!-- Fonts -->
    <link rel='shortcut icon' href='{{ asset('img/favicon-32x32.png') }}' type='image/x-icon'/ >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link href='https://fonts.googleapis.com/css?family=Signika+Negative:400,300,600,700' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.css"> -->
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/presets/preset3.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset(elixir('css/app.css')) }}" rel="stylesheet">
    @yield('style')
    <script src="//load.sumome.com/" data-sumo-site-id="12f06233c59661b6520eb33ff694b42a0caa863dcc1b7c72527912614ad97be2" async="async"></script>
    @yield('head_script')
</head>
<body>
    @yield('master_content')
    @include('layouts.partials.modal')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.1.1/jquery.rateyo.min.js"></script> -->
    <!-- <script type="text/javascript" src="{{ URL::asset('js/jquery.rateyo.js')}}"></script> -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/moment.js')}}"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('js/playligo-main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/main.js')}}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/sweetalert.min.js')}}"></script>
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

    <script>
    $('body').on('click', '.popupchat', function(event){
      event.preventDefault();
      $zopim(function() {
        $zopim.livechat.window.show();
      });
    });
    </script>

    @yield('script')

</body>
</html>
