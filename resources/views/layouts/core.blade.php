<!doctype html>
<html lang="en" prefix="og: https://ogp.me/ns# article: https://ogp.me/ns/article#">
    <head>
        <meta charset="utf-8" />
        <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
        <link rel="stylesheet" href="/assets/pub/css/main.css" />
        <link rel="icon" href="/assets/pub/img/old-circle-white.png" type="image/png" />
        <link
        href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&display=swap"
        rel="stylesheet" />

        <title>@section('html-title'){{ $look['title-text'] }}@show</title>

        <style>
        @foreach ($sections as $sec)
            @if ($sec->colour)
                nav#main-navigation a:hover.sec-{{ $sec->id }},
                nav#main-navigation a.selected.sec-{{ $sec->id }}
                {
                    background-color: {{ $sec->colour }};
                    color: white;
                }

                .sec-{{ $sec->id }} .section-title,
                .sec-{{ $sec->id }}.more a,
                .sec-{{ $sec->id }}.section,
                .sec-review.sec-{{ $sec->id }} header
                {
                    color: {{ $sec->colour }};
                }

                @if (!$look['disable-menu-underline'])
                nav#full-navigation a.sec-{{ $sec->id }}
                {
                    text-decoration-color: {{ $sec->colour }};
                }
                @endif
            @endif
        @endforeach

        @if ($look['disable-menu-underline'])
            nav#full-navigation a
            {
                text-decoration: none;
            }
        @endif

        @media (min-width:900px)
        {
            header#hdr-persistent nav#full-navigation nav.sections
            {
                grid-template-columns: repeat({{ $look['full-nav-cols'] }}, 1fr);
            }
        }
@section('head-css')
@show
        </style>

        <script>
@section('head-js')
        function toggleFull() {
            document.getElementById("hamburger").classList.toggle("selected");
            document.getElementById("full-navigation").classList.toggle("display");
        }
@show
        </script>

        <meta name="description"
                content="@section('head-og-description'){{ $look['meta-description'] }}@show" />

        <meta property="og:description" content="@yield('head-og-description')" />
        <meta property="og:title"
                content="@section('head-og-title'){{ $look['title-text'] }}@show" />

        <meta name="theme-color"
              content="@section('head-meta-themecolour'){{ $look['meta-theme-colour'] }}@show" />
@section('head-meta')
        <meta name="author" content="Felix" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="identifier" scheme="urn:issn" content="0140-0711" />
        <meta property="og:locale" content="en_GB" />
        <meta property="og:site_name" content="Felix Online: The Student Newspaper of Imperial College London" />
@show
    </head>
    <body>
        <a id="sec-top"></a>
        <header id="hdr-persistent">
            <a href="{{ route('home') }}">
                <img src="/assets/pub/img/cat-white.png" alt="Felix Cat" />
            </a>
            <a href="{{ route('home') }}" class="title">
                <h1>{{ $look['minihead-title'] }}</h1>
                <p class="tagline">{{ $look['tagline'] }}</p>
            </a>
            <a href="#" id="hamburger" onclick="toggleFull()">
                <img src="/assets/pub/img/hamburger.svg" alt="Menu Icon" />
            </a>
            <nav id="full-navigation">
                <nav class="sections">
                    <x-section-links :sections="$sections" />
                </nav>
                <nav class="sitenav">
@foreach ($aboutSection->articles as $article)
                    <a href="{{ $article->link() }}">{{ $article->headline }}</a>
@endforeach
                </nav>
            </nav>
        </header>
        <header id="hdr-masthead">
            <h1><a href="{{ route('home')}}">{{ $look['masthead-title'] }}</a></h1>
            <p class="tagline">
            @if ($issue ?? false)
                Issue {{ $issue->issue }}<br />
            @endif
                {{ $look['tagline'] }}</p>
            <p class="motto">
                <x-social :look="$look" />
                <br />
                {{ $look['motto'] }}
            </p>
        </header>
        <nav id="main-navigation">
            <x-section-links featuredonly="true" internal="true"
                        :sections="$sections" :selectedSection="$section ?? null" />
            <a href="#" onclick="toggleFull()">More</a>
        </nav>
@section('body')
@show
        <footer>
            <nav class="sections">
                <x-section-links :sections="$sections" />
            </nav>
            <nav class="meta">
@foreach ($aboutSection->articles as $article)
                    <a href="{{ $article->link() }}">{{ $article->headline }}</a>
@endforeach
            </nav>

            <section class="imprint">
                <p>{{ $look['address'] }}, {!! htmlspecialchars(
                                                str_replace(' ', '&nbsp;', $look['postcode']),
                                                ENT_COMPAT | ENT_HTML5, 'UTF-8', false) !!}</p>
                <p><a href="tel:{{ str_replace(' ', '', $look['telephone'])}}">{{ $look['telephone'] }}</a></p>
                <p>Copyright &copy; {{ $look['copyright'] }}</p>
                <p>Registered Newspaper ISSN {{ $look['issn'] }}</p>
            </section>
        </footer>
    </body>
</html>
