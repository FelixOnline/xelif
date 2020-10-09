@props(['articles',
        'look'])
<?php
$indexOffset = $look['one-index-featured'] ? 1 : 0;
?>
<article class="top-stories">
    <h1>Currently Trending</h1>
    <ol>
@foreach($articles as $article)
        <li><a href="{{ $article->link() }}">
            <span class="number">{{ $loop->index + $indexOffset }}</span>
            <p>{{ $article->headline }}</p>
        </a></li>
@endforeach
    </ol>
</article>
