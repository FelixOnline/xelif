<?php

$bringAttention = function ($inputHtml, $look) {
    if ($look == null)
        return $inputHtml;

    [
        'maxAttention' => $maxAttention,
        'attentionPunctuationSplit' => $punctuationMarks
    ] = $look;

    // html regex parse go brrrrr
    $paras = explode("</p>", $inputHtml, 1);
    $firstParaOpenPos = stripos($paras[0], "<p>");
    $firstParaText = html_entity_decode(
        $firstParaOpenPos === FALSE
            ? $paras[0]
            : substr($paras[0], $firstParaOpenPos + 3)
    );

    $firstPuncPos = strcspn($firstParaText, $punctuationMarks);

    if ($firstPuncPos < $maxAttention) {
        $attentionText = substr($firstParaText, 0, $firstPuncPos);
        $restText = substr($firstParaText, $firstPuncPos);
    } else {
        $lastAttentionWordDelim = strrpos(substr($firstParaText, 0, $maxAttention), " ");

        if ($lastAttentionWordDelim === FALSE) {
            $attentionText = $firstParaText;
            $restText = null;
        } else {
            $attentionText = substr($firstParaText, 0, $lastAttentionWordDelim);
            $restText = substr($firstParaText, $lastAttentionWordDelim);
        }
    }

    $paras[0] = ($firstParaOpenPos !== FALSE ? substr($paras[0], 0, $firstParaOpenPos + 3) : '')
        . "<b>$attentionText</b>$restText";

    return implode('</p>', $paras);
};

?>
{!! $bringAttention($block->input('html'), $look ?? null) !!}
