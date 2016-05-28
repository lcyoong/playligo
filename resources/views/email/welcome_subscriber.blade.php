@extends('layouts.email')
@section('email_content')
  <p>Dear {{ $subscriber->sub_name }},</p>
  <p>Congratulations!</p>
  <p>
    With Playligo, deciding a travel destination can now be painless. <br/>
    You’ll soon be able to watch travel video playlists and decide with confidence!
  </p>
  <img src="{{ asset('img/loop.gif') }}">
  <p>Hang in there and we’ll let you know as soon as we go live...</p>
  <p>As a token of our appreciation, we will like to present you with the "Ultimate Travel Checklist" attached in as a pdf document in this email.</p>
  <p>See you soon!</p>
  @include('email.footer')
@endsection
