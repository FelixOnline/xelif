<section class="review">
    <h2>{{ $block->input('title') }}</h2>
    <div class="stars">
        @for ($i = 0; $i < $block->input('stars') && $i < 5; $i++)
            ★
        @endfor
    </div>
    <dl>
        <dt>Director</dt>
        <dd>{{ $block->input('director') }}</dd>
        @if ($block->input('year'))
            <dt>Year</dt>
            <dd>{{ $block->input('year') }}</dd>
        @endif
        @if ($block->input('starring'))
            <dt>Starring</dt>
            <dd>{{ $block->input('starring') }}</dd>
        @endif
    </dl>
</section>
