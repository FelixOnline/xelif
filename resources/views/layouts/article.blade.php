@extends('layouts.core')

@section('html-title')
{{ $article->headline }} | {{ $section->title }} | @parent @endsection

@section('head-og-description'){{ $article->lede }}@endsection

@section('head-og-title'){{ $article->headline }} | {{ $look['title-text'] }}@endsection

@section('head-meta')
@parent
<meta property="og:type" content="article" />
<meta property="article:section" content="{{ $section->title }}" />
<meta property="article:published_time" content="{{ $article->publish_start_date }}" />
<meta property="article:modified_time" content="{{ $article->updated_at }}" />
<meta property="og:url" content="{{ $article->link() }}" />

@if ($article->hasImage('main', 'flexible'))
    <meta property="og:image" content="{{ $article->socialImage('main', 'flexible') }}" />
@endif

<link rel="canonical" href="{{ $article->link() }}" />
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "headline": "{{ $article->headline }}",
  "image": [
    "{{ $article->socialImage('main', 'flexible') }}"
   ],
  "datePublished": "{{ $article->publish_start_date }}",
  "dateModified": "{{ $article->updated_at }}"
}
</script>
@endsection

@if ($section->colour)
    @section('head-meta-themecolour'){{ $section->colour }}@endsection

    @section('head-css')
    @parent
        .full > article blockquote::before,
        .stars
        {
            color: {{ $section->colour }};
        }
    @endsection
@endif

@section('body')
<section class="full">
    <hr />
    <article>
    @php
        $media = $article->imageObject('main', 'flexible');
        $hasImage = !empty($media);
        $credit = $hasImage ? $media->getMetadata('credit') : null;
    @endphp
        <header
            @if (!$hasImage)
                class="noimg"
            @endif
            >
            <h1>{{ $article->headline }}</h1>
            <p class="lede">{{ $article->lede }}</p>
            @if ($hasImage)
                <figure>
                    <img src="{{ $article->image('main', 'flexible') }}"
                            alt="{{ $article->imageAltText('main') }}" />
                    @if ($credit)
                        <span class="credit">Photo: {{ $credit }}</span>
                    @endif
                </figure>
            @endif
            <section class="meta">
                <p class="section sec-{{ $section->id }}">
                    <a href="{{ $section->link() }}">{{ $section->title }}</a>
                </p>
@if (strtolower($section->title) != "about")
                <x-byline :article="$article" />
@endif
@if ($issue)
                <p class="issue">in Issue {{ $issue->issue }}</p>
@endif
            </section>
        </header>
        {!! $article->renderBlocks(true, [], ['look' => $look]) !!}
        <section class="social-footer">
            <x-social :look="$look" text="true" />
        </section>
    </article>

    @if (count($continueReading))
    <section class="continue">
        <h1>Also in this issue...</h1>
        @foreach ($continueReading as $nextArticle)
            <x-tease :article="$nextArticle" />
        @endforeach
    </section>
    @endif

    @if (count($topStories))
    <section class="top-stories">
        <h1>Top Stories</h1>
        @foreach ($topStories as $top)
            <x-tease :article="$top" image="true" />
        @endforeach
    </section>
    <section class="additional-articles about-articles">
    @foreach ($aboutSection->articles as $tease)
        <x-tease :article="$tease" :section="false" />
    @endforeach
    </section>
    @endif
</section>
<img src="{{ route('article.track', [$article->id]) }}" alt="Readership" />
@endsection
