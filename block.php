<?php
function block($id,$x1,$y1,$x2,$y2)
{
    global $status;
    if($status[$id] == 1){
        echo(' <path d="M '.$x1.' '.$y1.' L '.$x2.' '.$y2.'"/> ');
    }
}

block(1,300,200,400,200);
block(3,400,200,433,200);
block(5,433,200,466,200);
block(7,466,200,500,200);
block(9,500,200,533,200);
block(11,533,200,633,200);
block(13,633,200,700,200);
block(15,700,200,766,200);
block(17,766,200,833,200);

block(2,100,150,300,150);
block(4,300,150,400,150);
block(6,400,150,433,150);
block(8,433,150,466,150);
block(10,466,150,500,150);
block(12,500,150,533,150);
block(14,533,150,633,150);
block(16,633,150,700,150);
block(18,700,150,766,150);
block(20,766,150,833,150);

?>