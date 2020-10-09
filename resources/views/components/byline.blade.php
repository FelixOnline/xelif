@props(['article'])
<p class="byline">by
<x-name-list :writers="$article->writers" />
</p>
