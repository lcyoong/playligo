@extends('layouts.master_app')

@section('master_content')
<div class="homepage-container">
  @include('layouts.partials.menu_home')
  <!-- <div class="container">
    @include('layouts.partials.messagebag')
  </div> -->
  <div id="content-wrapper">
    @yield('content')
  </div>
</div><!--/#main-wrapper-->
@endsection
