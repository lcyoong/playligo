@extends('layouts.email')
@section('email_content')
  <p>Hi {{ $user->name }},</p>
  <p>We’re thrilled to have you on board!</p>
  <p>Gone are the days of ploughing through wordy articles to find the ideal travel destination. With Playligo, you just need to watch travel video playlists and decide with confidence!</p>
  <img src="{{ asset('img/giphy.gif') }}">
  <p>In case you haven’t, please watch our explainer video:<br/>
    <a href="https://www.youtube.com/watch?v=FVp-HQ58Vec">https://www.youtube.com/watch?v=FVp-HQ58Vec</a>
  </p>
  <p>Use Playligo before you go for your next trip!</p>
  @include('email.footer')
@endsection
