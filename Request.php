<?php
require_once('Rcon.php');

$host = '******'; // Server host name or IP
$port = ******;                      // Port rcon is listening on
$password = '*******'; // rcon.password setting set in server.properties
$timeout = 3;           // How long to timeout.

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

use Thedudeguy\Rcon;

setdata("signal",$_GET['id'],$_GET['status']);

if (isset($_GET['active'])){
    $rcon = new Rcon($host, $port, $password, $timeout);
    
    if ($rcon->connect())
    {
      #$rcon->sendCommand("say Hello");
      if($_GET['id'] == 1004 && $_GET['status'] == 1){
       $rcon->sendCommand("ssr -723 62 7958 1");       
      }
      if($_GET['id'] == 1004 && $_GET['status'] == 0){
       $rcon->sendCommand("ssr -723 62 7958 0");       
      }
    }
}
?>