<?php
function setdata($section, $key, $value) {
    $config_data = parse_ini_file("data.ini", true);
    $config_data[$section][$key] = $value;
    $new_content = '';
    foreach ($config_data as $section => $section_content) {
        $section_content = array_map(function($value, $key) {
            return "$key=$value";
        }, array_values($section_content), array_keys($section_content));
        $section_content = implode("\n", $section_content);
        $new_content .= "[$section]\n$section_content\n";
    }
    file_put_contents("data.ini", $new_content);
}


setdata("block",$_GET['id'],$_GET['status']);

?>