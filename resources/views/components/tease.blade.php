@props([
'article',
'section' => false,
'image' => false,
'imageWidth' => 0,
'lede' => true,
'byline' => false,
])
@if ($article != null)
    <article>
        <a href="{{ $article->link() }}">
            @if ($section)
                <p class="section">{{ $article->section->title }}</p>
            @endif
            @if ($image)
                @if ($article->hasImage('thumbnail', 'fixed'))
                    <img src="{{ $article->image('thumbnail', 'fixed', $imageWidth ? ['w'=>$imageWidth] : []) }}"
                         alt="{{ $article->imageAltText('thumbnail') }}"
                         loading="lazy"/>
                @elseif ($article->hasImage('main', 'flexible'))
                    <img src="{{ $article->image('main', 'flexible', $imageWidth ? ['w'=>$imageWidth] : []) }}"
                         alt="{{ $article->imageAltText('main') }}"
                         loading="lazy"/>
                @endif
            @endif
            <h1>{{ $article->headline }}</h1>
            @if ($lede)
                <p>{{ $article->lede }}</p>
            @endif
            @if ($byline)
                <x-byline :article="$article"/>
            @endif
        </a>
    </article>
@endif
