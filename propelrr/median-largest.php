<?php
// Get median and largest value

class MedianLargest {
    private $numbers;
    private $entries;

    public function __construct(array $numbers) {
        $this->entries = count($numbers);
        $this->numbers = $this->bubbleSort($numbers, $this->entries);
    }

    public function bubbleSort($arr, $len) {
        for($i=0; $i<$len; $i++) {
            for($j=0; $j<$len-$i-1; $j++) {
                if($arr[$j]>$arr[$j+1]) {
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
                }
            }
        }
        return $arr;
    }

    public function getMedian() {
        if ( $this->entries % 2 != 0 ) {
            return $this->numbers[$this->entries / 2];
        }

        $mid1 = $this->numbers[($this->entries - 1) / 2];
        $mid2 = $this->numbers[$this->entries / 2];
        $median = ( $mid1 + $mid2 ) / 2;

        return $median;
    }

    public function getLargest() {
        return end($this->numbers);
    }
}

class MyNumberSet extends MedianLargest {
    public function displayMedianAndLargest() {
        echo "Median: ".$this->getMedian()."\n";
        echo "Largest: ".$this->getLargest()."\n";
    }
}

$numbers = [2, 24, 3, 8, 6];
$myNumberSet = new MyNumberSet($numbers);
echo "Given: ";
foreach($numbers as $num) echo $num." ";
echo "\n";
echo $myNumberSet->displayMedianAndLargest();
?>