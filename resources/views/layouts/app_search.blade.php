@extends('layouts.master_app')

@section('master_content')
<div class="search-container">  
  @yield('content')
</div><!--/#main-wrapper-->
<footer id="footer">
  <div class="footer-menu">
    <div class="container">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('home') }}">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container text-center">
      <p><a href="#">Playligo </a>&copy; {{ date('Y') }} </p>
    </div>
  </div>
</footer>

@endsection
