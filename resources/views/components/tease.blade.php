@props([
    'article',
    'section' => true,
    'image' => false,
    'lede' => true,
    'byline' => false,
])
@if ($article != null)
    <article>
        <a href="{{ $article->link() }}">
    @if ($section)
            <p class="section">{{ $article->section->title }}</p>
    @endif
            <h1>{{ $article->headline }}</h1>
    @if ($image && $article->hasImage('main', 'flexible'))
            <img src="{{ $article->image('main', 'flexible') }}"
                 alt="{{ $article->imageAltText('main') }}"
                    loading="lazy" />
    @endif
    @if ($lede)
            <p>{{ $article->lede }}</p>
    @endif
    @if ($byline)
        <x-byline :article="$article" />
    @endif
        </a>
    </article>
@endif
