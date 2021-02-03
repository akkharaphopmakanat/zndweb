<?php 

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
    
    function sw($id,$lx,$ly,$pos)
    {
    global $status;  
    
    if($pos == "down")    
    {
        echo('<text font-size="8" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly - 16).'" fill="black">'.$id.'</text>');
    }
    if($pos == "up")    
    {
        echo('<text font-size="8" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly + 20).'" fill="black">'.$id.'</text>');
    }
    
    if($status[$id] == 0)
    {
        echo ('<a onclick="select('.$id.',1)">
        <circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#006666" /></a>');
    }
    if($status[$id] == 1)
    {
        echo ('<a onclick="select('.$id.',0)">
        <circle id="'.$id.'" cx="'.$lx.'" cy="'.$ly.'" r="6" stroke="black" stroke-width="3" fill="#00ffff" /></a>');
    }
    }
    
    function signal($id,$id2,$lx,$ly,$type,$pos){
        global $status;        
        
        echo('<text font-size="12.5" text-anchor="middle" font-weight="bold" x="'.($lx).'" y="'.($ly - 16).'" fill="black">'.$id.'</text>');
        if($pos == "R"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">➡</text>');
        }
        if($pos == "L"){
        echo('<text font-size="20" font-weight="bold" x="'.($lx - 10).'" y="'.($ly - 5).'" fill="black">⬅</text>');
        }
        
        if($type == "main")
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
        
        if($id2 != "none")
        {
            if($type == "main"){
                if($status[$id] == 1){
                    if($status[$id2] == 1){
                        echo('<text font-size="10" font-weight="bold" x="'.($lx - 18).'" y="'.($ly + 20).'" fill="black">Locked</text>');
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                        
                    }
                    else
                    {
                        echo '<a onclick="select('.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                    }
                }
                else
                {
                        echo '<a onclick="select('.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                }
            }
            
            
            elseif($type == "distance"){
                if($status[$id] == 0){
                    if($status[$id2] == 0){
                        echo('<text font-size="10" font-weight="bold" x="'.($lx - 18).'" y="'.($ly + 20).'" fill="black">Locked</text>');
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                    }
                    else
                    {
                        echo '<a onclick="select('.$id.',1)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
                    }
                }
                else
                {
                        echo '<a onclick="select('.$id.',0)">';
                        echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
                }
            }
            
            else{
                echo '<circle id="'.$id.'" cx="'.$lx.'" cy="'.($ly).'" r="6" stroke="gray" stroke-width="3" fill="gray" />';
            }
            
        }
        
        #if($status[$id] == 0){
        #    echo '<a onclick="select('.$id.',1)">';
        #    echo '<circle cx="'.$lx.'" cy="'.$ly.'" r="10" stroke='.$edge.' stroke-width="3" fill='.$s0.' />';
        #}
        #else
        #{
        #    echo '<a onclick="select('.$id.',0)">';
        #    echo '<circle cx="'.$lx.'" cy="'.$ly.'" r="10" stroke='.$edge.' stroke-width="3" fill='.$s1.' />';
        #    echo '<text font-size="10" font-weight="bold" x="'.$lllx.'" y="'.$llly.'" fill="black">'.$status['dw02'].'</text>';
        #}
    echo '</a>';
    }
    
    
    

?>


<svg width="1900" height="1200" xmlns="http://www.w3.org/2000/svg">
   <defs>
      <pattern id="smallGrid" width="10" height="10" patternUnits="userSpaceOnUse">
        <path d="M 10 0 L 0 0 0 10" fill="none" stroke="gray" stroke-width="0.5"/>
      </pattern>
      <pattern id="grid" width="100" height="100" patternUnits="userSpaceOnUse">
        <rect width="100" height="100" fill="url(#smallGrid)"/>
        <path d="M 100 0 L 0 0 0 100" fill="none" stroke="gray" stroke-width="1"/>
      </pattern>
    <marker id="arrowhead" markerWidth="10" markerHeight="7" 
    refX="0" refY="3.5" orient="auto">
      <polygon fill="blue" points="0 0, 3 3.5, 0 7" />
    </marker>
    </defs>
    <rect width="1900px" height="1200px" fill="url(#grid)" />
<defs>
    <filter x="0" y="0" width="1" height="1" id="platform">
      <feFlood flood-color="orange"/>
      <feComposite in="SourceGraphic" operator="xor" />
    </filter>
  </defs>
  
<g id="zone" stroke="green" stroke-width="3" fill="none" stroke-dasharray="5">
    <path d="M 150 0 L 150 300"/>
    <path d="M 600 0 L 600 170 L 650 170 L 650 300"/>
    <path d="M 900 0 L 900 170 L 975 170 L 975 300"/>
    <path d="M 0 300 L 1150 300 L 1150 400 L 1900 400"/>
    <path d="M 0 500 L 1150 500 L 1150 400"/>
</g>

<g id="platform" stroke="#dfe2e8" stroke-width="30" fill="">
    <path d="M 300 125 L 400 125"/>
    <path d="M 300 225 L 400 225"/>
    <path d="M 750 125 L 850 125"/>
    <path d="M 750 225 L 850 225"/>
    <path d="M 1350 125 L 1450 125"/>
    <path d="M 1350 225 L 1450 225"/>
    <path d="M 1350 325 L 1450 325"/>
</g>
    
<g id="track" stroke="black" stroke-width="5" fill="none">
    <path d="M 500 200 L 525 150" stroke="gray"/>
    <path d="M 100 150 L 1800 150"/>
    <path d="M 100 200 L 450 200"/>
    <path d="M 450 200 L 475 150"/>
    <path d="M 525 200 L 500 150"/>
    <path d="M 525 200 L 1800 200"/>
    
    <path d="M 450 200 L 500 200"/>

    
    <path d="M 975 100 L 1050 100 L 1075 150"/>
    <path d="M 1125 150 L 1150 200 L 1250 200 L 1275 150"/>
    <path d="M 1200 200 L 1225 250 L 1800 250"/>
    <path d="M 1250 250 L 1275 300 L 1800 300"/>
    <path d="M 1500 150 L 1525 200 L 1550 200 L 1575 150"/>
    <path d="M 1500 250 L 1525 300 L 1550 300 L 1575 250"/>
    
    <path d="M 100 450 L 1100 450"/>
    <path d="M 1000 400 L 1025 400 L 1050 450"/>
    <path d="M 925 450 L 900 400 L 800 400 L 775 450"/>
    <path d="M 925 450 L 900 400 L 800 400 L 775 450"/>
    <path d="M 625 450 L 600 400 L 500 400 L 475 450"/>
    <path d="M 325 450 L 300 400 L 200 400 L 175 450"/>
    <path d="M 300 400 L 275 350 L 200 350"/>
    
    <path d="M 100 600 L 1800 600"/>
</g>


<g id="label" text-anchor="middle" dominant-baseline="middle">
    <a xlink:href="https://enderice.com/znd/main/"><text font-size="14" font-weight="bold" x="75" y="100" fill="blue">Hagen-Vorhalle St.</text></a>
    <text font-size="16" font-weight="bold" x="1815" y="150" fill="black">A</text>
    <text font-size="16" font-weight="bold" x="1815" y="200" fill="black">A</text>
    <text font-size="16" font-weight="bold" x="965" y="100" fill="black">B</text>
    <text font-size="16" font-weight="bold" x="1115" y="450" fill="black">B</text>
    
    <text font-size="14" font-weight="bold" x="1000" y="375" fill="black">ANR Depo</text>

    <text font-size="24" font-weight="bold" x="350" y="100" fill="black">Diwater</text>
    <text font-size="24" font-weight="bold" x="800" y="100" fill="black">Armourer Cliff</text>
    <text font-size="24" font-weight="bold" x="1400" y="100" fill="black">Mittraphap Junction</text>
</g>
<g id="absblock">
    <?php 
    signal(1,2,250,200,"main","R");
    signal(2,1,200,200,"distance","R");
    signal(3,4,400,200,"main","R");
    signal(4,3,275,200,"distance","R");
    
    signal(5,6,300,150,"main","L");
    signal(6,5,550,200,"distance","L");
    signal(7,8,575,200,"main","L");
    signal(8,7,625,200,"distance","L");
    
    signal(9,10,700,150,"main","R");
    signal(10,9,650,150,"distance","R");
    signal(11,12,850,150,"main","R");
    signal(12,11,725,150,"distance","R");
    
    signal(13,14,750,200,"main","L");
    signal(14,13,875,200,"distance","L");
    signal(15,16,900,200,"main","L");
    signal(16,15,950,200,"distance","L");
    
    //signal3("dw03","dw02",250,200,"R");
    //signal4("dw01","dw04",300,150,"L");
    //signal3("dw04","dw01",575,200,"L");
    //signal2("dw05",600,200,"L");
    ?>

<script>
    function select(id,status) {
        $.get("Request.php?active=1&id="+id+"&status="+status);
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


</g>
<g id="switch">
    <?php
    sw(1001,450,200,"up");
    sw(1001,475,150,"down");
    sw(1002,500,150,"down");
    sw(1003,525,150,"down");
    sw(1004,1075,150,"up");
    sw(1005,1125,150,"down");
    sw(1005,1150,200,"up");
    sw(1006,1250,200,"up");
    sw(1006,1275,150,"down");
    sw(1007,1500,150,"down");
    sw(1007,1525,200,"up");
    sw(1008,1575,150,"down");
    sw(1008,1550,200,"up");
    ?>
    
</g>
</svg>