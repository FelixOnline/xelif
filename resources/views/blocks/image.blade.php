@php
    $media = $block->imageObject('image', 'flexible');
    $hasImage = !empty($media);
    $credit = $hasImage ? $media->getMetadata('credit') : null;
@endphp
<figure>
    <img src="{{ $block->image('image', 'flexible') }}"
            alt="{{ $block->imageAltText('image') }}" />
            <?php $caption = $block->imageCaption('image'); ?>
    @if ($credit)
        <span class="credit">Photo: {{ $credit }}</span>
    @endif
    @if ($caption)
        <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
