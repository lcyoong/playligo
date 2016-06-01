<div class="post">
  <div class="post-content">
    <div class="row">
      <div class="col-md-2 text-center">
        <div class="image-cropper">
          <img class="rounded" src="{{ !empty($owner->avatar) ? $owner->avatar : asset(config('playligo.avatar_default')) }}" >
        </div>
        {{ $owner->name }}
      </div>
      <div class="col-md-10">
        <div class="row meta-list">
          <div class="col-md-3 col-sm-3 col-xs-3">
            <i class="fa fa-clock-o"></i> {{ date(config('playligo.date_display_format'), strtotime($playlist->created_at)) }}
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3">
            <i class="fa fa-eye"></i>{{ $playlist->pl_view }} views
          </div>
          <div class="col-md-3 col-sm-3 col-xs-3">
            <select class="plRating">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>
          <div class="col-md-2 col-sm-2 col-xs-2">
            {{ Form::button('Rate', ['type'=>'button', 'class'=>'btn-xs btn-primary btn ratingPopUp_open']) }}
            <div id="ratingPopUp" class="well text-center">
              Enter your rating
              <select class="newPlRating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
          </div>
        </div>
        <div class="entry-content">
          <h5>{{ $playlist->pl_title }}</h5>
          <div>{{ $playlist->pl_description }}</div>
          Tags: {{$playlist_keys}}
        </div>
      </div>
    </div>
  </div>
</div>
