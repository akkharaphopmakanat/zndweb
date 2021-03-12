<?php
$occ = parse_ini_file("data.ini");
function occu($section, $key, $value) {
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
if(isset($_GET['id']) && isset($_GET['status'])){
occu("block",$_GET['id'],$_GET['status']);
}
function occupied($id,$tb1,$tg1,$p1,$p2,$p3,$p4){
    global $occ;
    
    if($occ[$id] == 1){
        echo('<path d="M '.$p1.' '.$p2.' L '.$p3.' '.$p4.'"/>');

    }
    if($occ[$tb1] == 1){
        if($occ[$tg1] == 0){
            occu("block",$id,"1");
        }
        if($occ[$tg1] == 1){
            occu("block",$id,"0");
            occu("block",$tb1,"0");
            occu("block",$tg1,"0");
        }
        
    }
    if($occ[$tg1] == 1){
        if($occ[$tb1] == 0){
            occu("block",$id,"1");
        }
        if($occ[$tb1] == 1){
            occu("block",$id,"0");
            occu("block",$tb1,"0");
            occu("block",$tg1,"0");
        }
    }
}

//occupied(100000,100001,100002,100,200,250,200);
//occupied(100010,100011,100012,250,200,400,200);
?>