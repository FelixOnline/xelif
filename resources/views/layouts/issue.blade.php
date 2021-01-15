@extends('layouts.core')

@section('head-js')
@parent
{{-- <script> --}}
window.onScroll = function(e) {

}
{{-- </script> --}}
@endsection

@section('body')
<section class="overview headlines">
    @foreach ($issue->articleRange('news', 0, 4, $singleIssueView ? false : 4) as $article)
        <x-tease image="true" byline="true" :article="$article" />
    @endforeach
    <section class="subheadlines">
        <x-trending :articles="$topStories" :look="$look" />
    </section>
</section>

<section class="overview additional-articles">
@foreach ($issue->articleRange('news', 4, null, $singleIssueView ? false : 4) as $article)
    <x-tease :article="$article" />
@endforeach
</section>

@foreach ($sections->filter(function ($s) {return strtolower($s->title) !== "news";}) as $dispSection)
@php
$sectionArticles = $issue->articleRange($dispSection->getSlug(), null, 4, !$singleIssueView);
@endphp

@if (count($sectionArticles))
<a id="sec-{{ $dispSection->id }}"></a>
<section class="overview sec-{{ $dispSection->id }}">
    <div class="section-title">
        <h2><a href="{{ $dispSection->link() }}">{{ $dispSection->title }}</a></h2>
        <p><span>Section Editor: </span><x-name-list :writers="$dispSection->writers" /></p>
    </div>
    <section class="overview additional-articles">
    @foreach ($sectionArticles as $tease)
        <x-tease :article="$tease" :image="true" />
    @endforeach
    </section>
    <p class="more sec-{{ $dispSection->id }}"><a href="{{ $dispSection->link() }}">Read more &raquo;</a></p>
</section>
@endif
@endforeach

<section class="overview">
    <div class="section-title">
        <h2><a href="{{ $aboutSection->link() }}">{{ $aboutSection->title }}</a></h2>
        <p><span>Editor: </span><x-name-list :writers="$dispSection->writers" /></p>
    </div>
    <p class="general-description">{{ $aboutSection->description }}</p>
    <section class="social-footer">
        <x-social text="true" :look="$look" />
    </section>
    <section class="overview additional-articles about-articles">
    @foreach ($aboutSection->articles as $tease)
        <x-tease :article="$tease" :section="false" />
    @endforeach
    </section>
    <p class="foot-motto">{{ $look['motto'] }}!</p>
</section>

@endsection
