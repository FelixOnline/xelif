<?php
    preg_match('/((?<=watch\?v=)|(?<=youtu.be\/))[a-zA-Z_0-9]+\/?/', $block->input('link'), $matches)
?>
<section class="youtube">
    <iframe width="560" height="315" src={{ "https://www.youtube-nocookie.com/embed/" . $matches[0] }} frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</section>
