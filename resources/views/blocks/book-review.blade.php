<section class="review">
    <h2>{{ $block->input('title') }}</h2>
    <div class="stars">
        @for ($i = 0; $i < $block->input('stars') && $i < 5; $i++)
            ★
        @endfor
    </div>
    <dl>
        <dt>Author</dt>
        <dd>{{ $block->input('author') }}</dd>
        @if ($block->input('publisher'))
            <dt>Publisher</dt>
            <dd>{{ $block->input('publisher') }}</dd>
        @endif
    </dl>
</section>
