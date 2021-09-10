@props(['writers'])
@forelse (($writers ?? []) as $writer)
    <span class="name">
    @if ($loop->remaining > 1)
            {!! $writer->nameFormatted() !!}</span>,
    @elseif ($loop->remaining == 1)
    {!! $writer->nameFormatted() !!}</span><span> and</span>
    @else
    {!! $writer->nameFormatted() !!}</span>
    @endif
@empty
    Sir Walter Plinge
@endforelse
