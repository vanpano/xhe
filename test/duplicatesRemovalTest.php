<?php

$file = 'C:\Users\user741\Downloads\1ml.txt';
$array = file($file, FILE_IGNORE_NEW_LINES);

$unique = array_unique($array);
file_put_contents('C:\Users\user741\Downloads\1ml-uniq.txt', implode("\n", $unique));

?>