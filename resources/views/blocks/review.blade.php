<section class="review">
    <p class="what">{{ $block->input('what') }}</p>
    <h2>{{ $block->input('title') }}</h2>
    <div class="stars">
        @for ($i = 0; $i < $block->input('stars') && $i < 5; $i++)
            ★
        @endfor
    </div>
    <dl>
        <dt>Where</dt>
        <dd>{{ $block->input('where') }}</dd>
        <dt>When</dt>
        <dd>{{ $block->input('when') }}</dd>
        <dt>Cost</dt>
        <dd>{{ $block->input('cost') }}</dd>
    </dl>
</section>
