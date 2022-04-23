<?php  
echo "Enter number from 1 to 20: ";
$handle = fopen ("php://stdin","r");
$num = trim(fgets($handle));

function series($num) {  
    if ($num == 0) {  
        return 0;  
    } else if ( $num == 1) {  
        return 1;  
    } else {  
        return (series($num-1) + series($num-2));  
    }   
}  
 
if ($num < 1 OR $num > 20) {
    echo "Please input numbers from 1 to 20 only!\n";
    exit;
}

for ($i = 0; $i < $num; $i++){  
    echo series($i) . ($i != $num-1 ? ", " : "");  
}  
echo "\n";

