<meta property="og:url"                content="{{ Request::url() }}" />
<meta property="og:type"               content="website" />
<meta property="og:title"              content="{{ $page_title or config('playligo.title') }}" />
<meta property="og:description"        content="{{ $page_desc or config('playligo.desc') }}" />
<meta property="og:image"              content="{{ $page_img or asset('img/logo.png') }}" />
<meta property="fb:app_id"             content="{{ env('FACEBOOK_CLIENT_ID') }}" /> 
