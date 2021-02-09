@props(['article'])
<p class="byline">by
<x-name-list :writers="$article->writers" />
<br>
@if ($article->publish_start_date)
    <span>on {{ date('j F Y',strtotime($article->publish_start_date)) }}</span>
@endif
</p>
