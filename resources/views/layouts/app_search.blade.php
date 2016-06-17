@extends('layouts.master_app')

@section('master_content')
<div class="search-container">
  @yield('content')
</div><!--/#main-wrapper-->
@include('layouts.partials.footer')
@endsection
