{{ Form::open(['url'=>$search_path]) }}
@yield('filter_content')
<div class="form-group">
    <button type="submit" class="btn btn-default dropdown-toggle "><i class="fa fa-search"></i></button>
    <button type="submit" id="btn-clear" class="btn btn-default dropdown-toggle btn-clear"><i class="fa fa-refresh"></i></button>
</div>
{{ Form::close() }}
