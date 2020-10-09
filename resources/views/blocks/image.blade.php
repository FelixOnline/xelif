<figure>
    <img src="{{ $block->image('image', 'desktop') }}"
            alt="{{ $block->imageAltText('image') }}" />
            <?php $caption = $block->imageCaption('image'); ?>
    @if ($caption)
        <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
