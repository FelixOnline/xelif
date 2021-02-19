@props([
    'look',
    'text' => false,
])
<a href="mailto:{{ $look['email'] }}" class="social-link email-link">
    <img src="/assets/pub/img/at.svg" alt="At-Symbol" />
@if ($text)
    <p>{{ $look['email'] }}</p>
@endif
</a>
<a href="https://twitter.com/{{ $look['twitter'] }}" class="social-link twitter-link">
    <img src="/assets/pub/img/twitter.svg" alt="Twitter Logo" />
@if ($text)
    <p>{{ "@".$look['twitter'] }}</p>
@endif
</a>
<a href="https://facebook.com/{{ $look['facebook'] }}" class="social-link fb-link">
    <img src="/assets/pub/img/facebook.png" alt="Facebook Logo" />
@if ($text)
    <P>fb.com/{{ $look['facebook'] }}</p>
@endif
</a>
<a href="https://instagram.com/{{ $look['instagram'] }}" class="social-link ins-link">
    <img src="/assets/pub/img/instagram.svg" alt="Instagram Logo" />
@if ($text)
    <P>{{ $look['instagram'] }}</p>
@endif
</a>

