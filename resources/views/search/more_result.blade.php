@foreach(array_chunk($result, 4) as $item_set)
    <div class="row">
    @foreach($item_set as $item)
        <div class="col-md-3 col-sm-3 col-xs-3 select_video_thumbnail">
            <a href="{{ url('search/preview/' . $item->id->videoId) }}" class="btn-modal"><img id="thumb{{ $item->id->videoId }}" src="{{ $item->snippet->thumbnails->medium->url }}" class="img-rounded @if (key_exists($item->id->videoId, $selected)) selected_disable @endif" width="100%"></a>
            <div class="select_video_control">
                @if (key_exists($item->id->videoId, $selected))
                    <a href="#"><i class="fa fa-check-circle fa-3"></i> Added</a>
                @else
                    <a id="{{ $item->id->videoId }}" href="{{ url('search/add_video') }}" class="add_video_button"><i class="fa fa-plus-circle fa-3"></i> {{ trans('form.add_to_playlist') }}</a>
                @endif
            </div>
        </div>
    @endforeach
    </div>
@endforeach
<a href="{{ url('/results/more?' . Request::getQueryString()) }}">{{ Form::button(trans('form.btn_load_more'), ['type'=>'button', 'class'=>'form-control btn btn-primary']) }}</a>
