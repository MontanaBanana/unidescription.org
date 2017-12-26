<?php

$text = 'here is a row and here are some rows';
$word = "row";
$p_word = "ro";
$text = preg_replace("/\b$word\b/", $p_word, $text);

echo $text;
echo "\n";
