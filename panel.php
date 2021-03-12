<?php 
error_reporting(E_ALL ^ E_NOTICE);
#setdata("signal","dw01","wow");
$status = parse_ini_file("data.ini");

    function cut($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    
    function invert($id){
        global $status;
        if($status[$id] == 0){
            return 1;
        }
        if($status[$id] == 1){
            return 0;
        }
    }
    
    function lock() {
        global $status;
        foreach (func_get_args() as $param) {
            if($status[$param] == 1){
                return 1;
            }
            if($param==1){
                return 1;
            }
        }
        }

    function button($id,$lx,$ly,$st){
    if($st == 1){
        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="#006600" stroke-width="3" fill="#ffffff" /></a>)' ;  
    }
    else{
        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="#006600" stroke-width="3" fill="#006600" /></a>)' ;  
    }
        
    }
    function sw($id,$lock,$lx,$ly,$pos)
    {
    global $status;  
    
    if($pos == "down")    
    {
        echo('<text font-size="8" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly - 10).'" fill="black">'.$id.'</text>');
    }
    if($pos == "up")    
    {
        echo('<text font-size="8" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly + 14).'" fill="black">'.$id.'</text>');
    }
    
    if($status[$id] == 0)
    {
        
        if($lock == 1){
        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#006666" /></a>)' ;      
        echo('<text font-size="10" font-weight="bold" x="'.($lx - 6.5).'" y="'.($ly + 10).'" fill="black">🔒</text>');
        }
        else{
        echo ('<a onclick="select(2,'.$id.',1)">
        <circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#006666" /></a>');            
        }

    }
    if($status[$id] == 1)
    {
        if($lock == 1){
        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#00ffff" /></a>)' ;      
        echo('<text font-size="10" font-weight="bold" x="'.($lx - 6.5).'" y="'.($ly + 10).'" fill="black">🔒</text>');
        }
        else{
        echo ('<a onclick="select(2,'.$id.',0)">
        <circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#00ffff" /></a>');
    }
    }
    }
    
    
    function signal($id,$id2,$lx,$ly,$type,$pos){
        global $status;        
        
        if($type == "crossing"){
        }
        else{
        echo('<text font-size="12.5" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly - 16).'" fill="black">'.$id.'</text>');
        }
        
        if($pos == "R"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">⇀</text>');
        }
        elseif($pos == "L"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">↼</text>');
        }
        else{
            
        }
        

        if($type == "main" or $type == "sp")
        {
            $edge = "black";
            $s0 = "#ff0000" ;
            $s1 = "#00ff00" ;
        }
        elseif ($type == "distance") {
            $edge = "orange";
            $s0 = "#ffff00" ;
            $s1 = "#00ff00" ;
        }
        elseif ($type == "crossing") {
            $edge = "red";
            $s0 = "#000000" ;
            $s1 = "#ffffff" ;
        }
        elseif($type == "auto")
        {
            $edge = "#aaaaaa";
            $s0 = "#ff0000" ;
            $s1 = "#ffff00";
            $s2 = "#00ff00" ;
        }       
        else{
            $edge = "black";
            $s0 = "grey" ;
            $s1 = "grey" ;           
        }
        
        if($id2 != "none")
        {
            if($type == "sp"){
                if($status[$id] == 1){
                    if($status[$id2] == 1){
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                        echo('<text font-size="10" font-weight="bold" x="'.($lx - 6).'" y="'.($ly + 10).'" fill="black">🔒</text>');
                        
                    }
                    else
                    {
                        echo '<a onclick="select(1,'.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                    }
                }
                else
                {
                        echo '<a onclick="select(1,'.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                }
                echo '</a>';
            }
            
            elseif($type == "main"){
                if($status[$id] == 0){
                    if($id2 == 1){

                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                        echo('<text font-size="10" font-weight="bold" x="'.($lx - 6).'" y="'.($ly + 10).'" fill="black">🔒</text>');
                    }
                    else
                    {
                        echo '<a onclick="select(1,'.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                    }
                }
                else
                {
                        echo '<a onclick="select(1,'.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                }
                echo '</a>';
            }
 
            elseif($type == "distance"){
                if($status[$id] == 0){
                    if($status[$id2] == 0){
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                        echo('<text font-size="10" font-weight="bold" x="'.($lx - 6).'" y="'.($ly + 10).'" fill="black">🔒</text>');
                    }
                    else
                    {
                        echo '<a onclick="select(1,'.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                    }
                }
                else
                {
                        echo '<a onclick="select(1,'.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                }
            }
            
            elseif($type == "dummy"){
                echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke="gray" stroke-width="3" fill="gray" />';
            }
            
        }
        
        elseif($id2==0)
        {
                if($status[$id] == 1){
                        echo '<a onclick="select(1,'.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                }
                else
                {
                        echo '<a onclick="select(1,'.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                }
                echo '</a>';
        }      
        
    }
function sep($id,$id2,$lx,$ly){
   global $status;
   echo(' <path stroke="black" stroke-width="5" d="M '.$lx.' '.($ly+7).' L '.$lx.' '.($ly-7).'"/> ');
   
   if($status[$id] == "0" or $status[$id] == "3"){
   echo('<text font-size="10" x="'.($lx - 12).'" y="'.($ly + 12).'" fill="black">'.$id.'</text>');
   }
   else
   {
   echo('<text font-size="10" x="'.($lx - 12).'" y="'.($ly + 12).'" fill="red">'.$id.'</text>');
   }
   
   if($status[$id2] == "0" or $status[$id2] == "3"){   
   echo('<text font-size="10" x="'.($lx + 12).'" y="'.($ly + 12).'" fill="black">'.$id2.'</text>');
   }
   else{
       echo('<text font-size="10" x="'.($lx + 12).'" y="'.($ly + 12).'" fill="red">'.$id2.'</text>');
   }
}
function asignal($id,$id2,$lx,$ly,$type,$pos){
        global $status;
        echo('<text font-size="12.5" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly - 16).'" fill="black">'.$id.'</text>');
        
        if($pos == "R"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">⇀</text>');
        }
        elseif($pos == "L"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">↼</text>');
        }
        else{
            
        }
            $edge = "#aaaaaa";
            $s0 = "#ff0000" ;
            $s1 = "#ffff00";
            $s2 = "#00ff00" ;
    if($status[$id] == 1){
            echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
    }
    elseif($status[$id] == 2){
            echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
    }
    
    elseif($status[$id] == 3)
    {
            echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s2.' />';
    }
    echo('<text font-size="10" font-weight="bold" x="'.($lx-3).'" y="'.($ly + 3).'" fill="black">A</text>');
}    
    
    

?>
<script>
    function select(active,id,status) {
        $.get("Request.php?active="+active+"&id="+id+"&status="+status);
        document.getElementById(id).classList.add("blink");
    }
    
    function showTooltip(evt, text) {
      let tooltip = document.getElementById("tooltip");
      tooltip.innerHTML = text;
      tooltip.style.display = "block";
      tooltip.style.left = evt.pageX + 10 + 'px';
      tooltip.style.top = evt.pageY + 10 + 'px';
    }

    function hideTooltip() {
      var tooltip = document.getElementById("tooltip");
      tooltip.style.display = "none";
    }
</script>
<style>

    .blink {
      animation: blinker 0.25s linear infinite;
    }
    
    @keyframes blinker {
      50% {
        opacity: 0;
      }
    }
</style>
<style>
body {
  background-color: gray;
}
</style>

<svg width="3800" height="1200" xmlns="http://www.w3.org/2000/svg">
   <defs>
      <pattern id="smallGrid" width="10" height="10" patternUnits="userSpaceOnUse">
        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="#aaaaaa" stroke-width="0.5"/>
      </pattern>
      <pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse">
        <rect width="100" height="100" fill="url(#smallGrid)"/>
        <path d="M 100 0 L 0 0 0 100" fill="none" stroke="#bbbbbb" stroke-width="1"/>
      </pattern>
    <marker id="arrowhead" markerWidth="10" markerHeight="7" 
    refX="0" refY="3.5" orient="auto">
      <polygon fill="blue" points="0 0, 3 3.5, 0 7" />
    </marker>
    </defs>
    <rect width="3800px" height="1200px" fill="url(#grid)" />
<defs>
    <filter x="0" y="0" width="1" height="1" id="platform">
      <feFlood flood-color="orange"/>
      <feComposite in="SourceGraphic" operator="xor" />
    </filter>
  </defs>
  
<g id="zone" stroke="none" stroke-width="3" fill="none" stroke-dasharray="5">
    <path d="M 150 0 L 150 250"/>
    <path d="M 600 0 L 600 170 L 650 170 L 650 250"/>
    <path d="M 900 0 L 900 170 L 975 170 L 975 250"/>
    <path d="M 0 250 L 1150 250 L 1150 400 L 1900 400"/>
    <path d="M 0 400 L 1150 400 L 1150 400"/>
</g>

<g id="platform" stroke="#de8928" stroke-width="30" fill="">
    
    <path d="M 300 125 L 400 125"/><path d="M 300 225 L 400 225"/>
    <path d="M 533 125 L 633 125"/><path d="M 533 225 L 633 225"/>
    <path d="M 866 125 L 966 125"/><path d="M 866 225 L 966 225"/>
    <path d="M 1800 25 L 1900 25"/><path d="M 1800 125 L 1900 125"/>
    <path d="M 2500 225 L 2600 225"/><path d="M 2500 325 L 2600 325"/>
    <path d="M 2800 225 L 2900 225"/><path d="M 2800 325 L 2900 325"/>
    <path d="M 3100 225 L 3200 225"/><path d="M 3100 325 L 3200 325"/>
    <path d="M 3400 225 L 3500 225"/><path d="M 3400 325 L 3500 325"/>
    
    <path d="M 300 525 L 400 525"/><path d="M 300 625 L 400 625"/>
</g>
    
<g id="track" stroke="black" stroke-width="5" fill="none">
    <path d="M 100 150 L 1225 150 L 1275 250 L 2000 250 L 3700 250"/>
    <path d="M 100 200 L 1200 200 L 1250 300 L 2000 300 L 3700 300"/>
    
    <path d="M 1350 300 L 1375 250 L 1400 250 L 1425 300"/>
    
    <path d="M 1475 250 L 1525 350 L 1700 350"/>
    <path d="M 1450 300 L 1500 400 L 1700 400"/>

    <path d="M 1525 250 L 1625 50 L 2150 50 L 2250 250"/>
    <path d="M 1550 300 L 1650 100 L 2125 100 L 2225 300"/>
    
    <path d="M 1400 100 L 1650 100"/><path d="M 1525 100 L 1550 50 L 1650 50"/>
    
    <path d="M 1625 250 L 1650 200 L 2050 200 L 2075 250"/>
    <path d="M 1675 200 L 1700 150 L 2000 150 L 2025 200"/>
    
    <path d="M 2300 250 L 2325 300 L 2350 300 L 2375 250"/>
    <path d="M 2400 300 L 2425 325 L 2425 350 L 2400 375 L 2350 375"/><path d="M 2400 375 L 2500 375 L 2525 350"/>
    <path d="M 2450 300 L 2475 350 L 2700 350 L 2725 400"/><path d="M 2550 350 L 2575 400 L 2750 400 L 2775 450"/>
    <path d="M 2600 400 L 2625 450 L 3000 450"/><path d="M 2825 450 L 2850 400 L 3000 400"/><path d="M 2875 400 L 2900 350 L 3000 350"/>

    <path d="M 100 550 L 1800 550"/>
    <path d="M 100 600 L 1800 600"/>
</g>


<g id="label" text-anchor="middle" dominant-baseline="middle">
    <a xlink:href="https://enderice.com/znd/main/"><text font-size="14" font-weight="bold" x="75" y="100" fill="blue">Hagen-Vorhalle St.</text></a>
    <a xlink:href="https://enderice.com/znd/srj/srj1"><text font-size="14" font-weight="bold" x="1750" y="375" fill="blue">SRJ Western Line</text></a>
    <text font-size="20" font-weight="bold" x="350" y="80" fill="black">Oneone Whero</text>
    <text font-size="16" font-weight="bold" x="350" y="100" fill="black">(Tanah Merah)</text>
    <text font-size="20" font-weight="bold" x="583" y="90" fill="black">Kaiwawao</text>
    <text font-size="20" font-weight="bold" x="916" y="90" fill="black">Pulau Tekong</text>
    <text font-size="20" font-weight="bold" x="1850" y="75" fill="black">Mittraphap Junction</text>
    <text font-size="20" font-weight="bold" x="2550" y="200" fill="black">Sundew School</text>
    <text font-size="20" font-weight="bold" x="2850" y="200" fill="black">ANR Depo</text>
    <text font-size="20" font-weight="bold" x="3150" y="200" fill="black">Glenmarie</text>
    <text font-size="20" font-weight="bold" x="3450" y="200" fill="black">Pulau Aur</text>
    
    
     <rect x="200" y="250" width="800" height="150" style="fill:black;stroke:green;stroke-width:5;fill-opacity:0.5;stroke-opacity:0.5" />
    <text font-size="20" font-weight="bold" x="600" y="275" fill="white">EnderIce Southern Main Line</text>
    <text font-size="15" font-weight="" x="325" y="302" fill="white">Give control to local station</text>
    <?php
        button("test",225,300,0);
    ?>

</g>
<g id="sep" text-anchor="middle" dominant-baseline="middle">
<?php
sep("44","B0",1300,250);
sep("41","B0",1300,300);

sep("B0","B8",1725,50);
sep("B0","B7",1725,100);
sep("B0","B6",1725,150);
sep("B0","B5",1725,200);
sep("B0","B4",1675,250);
sep("B0","B3",1650,300);
sep("B0","B2",1550,350);
sep("B0","B1",1550,400);
?>
</g>
<g id="block"  stroke="red" stroke-width="5" >
<?php
include "block.php";
?>
</g>

</g>

<g id="absblock">
    <?php 
    asignal(0,-1,266,200,"auto","R");
    asignal(1,-1,300,200,"auto","R");
    asignal(2,-1,300,150,"auto","L");
    asignal(3,-1,400,200,"auto","R");
    asignal(4,-1,400,150,"auto","L");
    asignal(5,-1,433,200,"auto","R");
    asignal(6,-1,433,150,"auto","L");
    asignal(7,-1,466,200,"auto","R");
    asignal(8,-1,466,150,"auto","L");
    asignal(9,-1,500,200,"auto","R");
    asignal(10,-1,500,150,"auto","L");
    asignal(11,-1,533,200,"auto","R");
    asignal(12,-1,533,150,"auto","L");
    asignal(13,-1,633,200,"auto","R");
    asignal(14,-1,633,150,"auto","L");

    asignal(15,-1,700,200,"auto","R");
    asignal(16,-1,700,150,"auto","L");

    asignal(17,-1,766,200,"auto","R");
    asignal(18,-1,766,150,"auto","L");

    asignal(19,-1,833,200,"auto","R");
    asignal(20,-1,833,150,"auto","L");

    asignal(21,-1,966,200,"auto","R");
    asignal(22,-1,966,150,"auto","L");

    asignal(23,-1,1033,200,"auto","R");
    asignal(24,-1,1033,150,"auto","L");
    asignal(35,-1,1066,200,"auto","R");
    asignal(36,-1,1066,150,"auto","L");
    asignal(37,-1,1100,200,"auto","R");
    asignal(38,-1,1100,150,"auto","L");
    asignal(39,-1,1133,200,"auto","R");
    asignal(40,-1,1133,150,"auto","L");
    asignal(41,-1,1166,200,"auto","R");
    asignal(42,-1,1166,150,"auto","L");

    ?>
</g>
<g id="switch">
    <?php
    sw(10001,0,1350,300,"up");
    sw(10001,0,1375,250,"down");
    sw(10002,0,1425,300,"up");
    sw(10002,0,1400,250,"down");
    sw(10003,0,1450,300,"down");
    sw(10004,0,1475,250,"down");
    sw(10005,0,1550,300,"up");
    sw(10006,0,1525,250,"up");
    ?>
</g>




</svg>

