<?php
    $string = ob_get_clean();

    $output = str_replace(array("\r\n", "\r"), "\n", $string);
    $lines = explode("\n", $output);
    $new_lines = array();

    foreach ($lines as $i => $line) {
        if(!empty($line))
            $new_lines[] = trim($line);
    }
    echo implode($new_lines);
?>