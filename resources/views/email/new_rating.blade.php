@extends('layouts.email')
@section('email_content')
  <p>Dear {{ $owner->name }},</p>
  <p>Aha! Your playlists have been seen and reviewed.</p>
  <p>See them here:<br/> <a href="{{ url('public_playlist/' . $playlist->pl_id) }}">{{ url('public_playlist/' . $playlist->pl_id) }}</a></p>
  <img src="{{ asset('img/clap.gif') }}">
  @include('email.footer')
@endsection
