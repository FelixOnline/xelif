@props([
    'pageable',
    'page',
    'numPages'
])
<p>
@if ($page > 1)
    <a href="{{ $pageable->link($page - 1) }}">&laquo; Previous</a>
@endif
</p><p>
@if ($numPages > 1)
    {{ $page }} / {{ $numPages }}
@endif
</p><p>
@if ($numPages - $page > 0)
    <a href="{{ $pageable->link($page + 1) }}">Next &raquo;</a>
@endif
</p>
