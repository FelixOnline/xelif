@php
    $media = $block->imageObject('image', 'desktop');
    $hasImage = !empty($media);
    $credit = $hasImage ? $media->getMetadata('credit') : null;
@endphp
<figure>
    <img src="{{ $block->image('image', 'desktop') }}"
            alt="{{ $block->imageAltText('image') }}" />
            <?php $caption = $block->imageCaption('image'); ?>
    @if ($credit)
        <span class="credit">Photo: {{ $credit }}</span>
    @endif
    @if ($caption)
        <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
