@php
    $media = $block->imageObject('image', 'flexible');
    $hasImage = !empty($media);
    $credit = $hasImage ? $media->getMetadata('credit') : null;
@endphp
<figure style="width: {{ $block->input('width') }}%;
    @if ($block->input('float') == 'left')
    float: left;
    margin-right: 2em;
    @elseif ($block->input('float') == 'right')
    float: right;
    margin-left: 2em;
    @endif
">
    <img src="{{ $block->image('image', 'flexible') }}"
         alt="{{ $block->imageAltText('image') }}"/>
    <?php $caption = $block->imageCaption('image'); ?>
    @if ($credit)
        <span class="credit">Photo: {{ $credit }}</span>
    @endif
    @if ($caption)
        <figcaption>{{ $caption }}</figcaption>
    @endif
</figure>
