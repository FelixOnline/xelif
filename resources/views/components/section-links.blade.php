@props([
    'sections',
    'selectedSection' => null,
    'featuredonly' => false,
    'internal' => false,
])
@foreach($sections as $section)
@if (!$featuredonly || $section->featured)
    <a
    @if ($internal)
        href="{{ route('home') }}#sec-{{ $loop->first ? 'top' : $section->id }}"
    @else
        href="{{ route('section', $section->getSlug()) }}"
    @endif
    class="sec-{{ $section->id }} @if ($selectedSection && $selectedSection->id == $section->id) selected @endif">
        {{ $section->title }}
    </a>
@endif
@endforeach
