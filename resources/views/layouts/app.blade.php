@extends('layouts.master_app')

@section('master_content')
<div id="main-wrapper" class="homepage">
  @include('layouts.partials.menu')
<div class="container">
  @include('layouts.partials.messagebag')
</div>
<div id="content-wrapper">
  @yield('content')
</div>
</div><!--/#main-wrapper-->
@include('layouts.partials.footer')
@endsection
