{{-- @dd($meta) --}}
<meta name="title" content="{{ @$seo->home_page_seo_title ?? "Kantipur Cinemas"}}">
<meta name="description" content="{{ strip_tags(@$seo->home_page_seo_metadescription ?? "Kantipur Cinemas") }}">
<meta name="keywords" content="{{ @$seo->home_page_seo_keyword ?? "Kantipur Cinemas"}}">
<meta property="og:title" content="{{  @$seo->home_page_seo_title ?? "Kantipur Cinemas"}}">
<meta property="og:image" content="{{ (@$logo->website_favicon ?? "Kantipur Cinemas") }}">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="675">
<meta property="og:image:alt" content="{{  @$seo->home_page_seo_title ?? "Kantipur Cinemas" }}">
<meta property="og:description" content="{{ strip_tags(@$seo->home_page_seo_keyword ?? "Kantipur Cinemas") }}">
<meta property="og:url" content="{{ url()->current() }}" />
<meta property="og:site_name" content="{{ @$systemSetting->site_name ?? "Kantipur Cinemas" }}" />
{{-- <meta property="og:locale" content="ne_NP" /> --}}
<meta name="twitter:card" content="{{ (@$logo->website_favicon ?? "Kantipur Cinemas") }}">
<meta name="twitter:site" content="{{ @$seo->twitter_url ?? "Kantipur Cinemas" }}" />
<meta name="allow-search" content="yes" />
<meta name="author" content="{{ @$systemSetting->site_name ?? "Kantipur Cinemas" }}" />
<meta name="copyright" content="{{ date('Y') }} {{ @$systemSetting->site_name  ?? "Kantipur Cinemas"}}" />
<meta name="coverage" content="Worldwide" />
<meta name="identifier" content="{{ url()->current() }}" />
<meta name="language" content="{{ app()->getLocale() }}" />
<meta name="Robots" content="home,FOLLOW" />
<link rel="canonical" href="{{ url()->current() }}" />
<meta name="Googlebot" content="home, follow" />
<link rel="next" href="{{ route('home') }}" />
<meta property="fb:admins" content="" />
<meta property="fb:page_id" content="104637888619621" />
<meta property="fb:pages" content="104637888619621" />
<meta property="og:type" content="article" />
<meta property="ia:markup_url" content="{{ url()->current() }}">
<meta property="ia:rules_url" content="{{ url()->current() }}">
<meta property="fb:app_id" content="296672421803651" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="{{ route('home') }}" />
<meta name="twitter:title" content="{{ substr(@$seo->home_page_seo_title ?? "Kantipur Cinemas", 0, 70) }}" />
<meta name="twitter:description" content="{{ substr(strip_tags(@$seo->home_page_seo_metadescription ?? "Kantipur Cinemas"), 0, 120) }}" />
<meta name="twitter:image" content=" {{ @$meta['og_image'] ?? "Kantipur Cinemas" }}" />
<meta name="google-site-verification" content="xLTE-QX5uTNDPc6lsm6-5Nx5P5VgF28sQeJg5vyCg2o" />
