<?php

class Levenshtein {

    public $string1;
    public $string2;

    public function __construct($string1, $string2) {
        $this->string1 = $string1;
        $this->string2 = $string2;
    }

    public function editDistance($string1, $string2, $string_length1, $string_length2) {

        for ($srt1 = 0; $srt1 <= $string_length1; $srt1++) {
            for ($srt2 = 0; $srt2 <= $string_length2; $srt2++) {

// If first string is empty, insert all characters of second string 
                if ($srt1 == 0) {
                    $distance[$srt1][$srt2] = $srt2; 
                }
// If second string is empty,insert all characters of first string  
                else if ($srt2 == 0) {
                    $distance[$srt1][$srt2] = $srt1;
                }
// If last characters are same,ignore last char and recur for remaining string 
                else if ($string1[$srt1 - 1] == $string2[$srt2 - 1]) {
                    $distance[$srt1][$srt2] = $distance[$srt1 - 1][$srt2 - 1];
                }
                // If last character are different,consider all possibilities and find minimum 
                else {
                    $distance[$srt1][$srt2] = 1 + min($distance[$srt1][$srt2 - 1], // Insert 
                                    $distance[$srt1 - 1][$srt2], // Remove 
                                    $distance[$srt1 - 1][$srt2 - 1]); // Replace 
                }
            }
        }
        return $distance[$string_length1][$string_length2];
    }

}

class HammingClass extends Levenshtein {

    public function hammingDistance($string1, $string2) {

        $count = 0;
        for ($i = 0; isset($string1[$i]) != ''; $i++) {
            if ($string1[$i] != $string2[$i])
                $count++;
        }
        return $count;
    }

    public function __destruct() {
        echo "destroy (stopped)";
    }

}

$object = new HammingClass('this is a test', 'that is a test');
$string1 = $object->string1;
$string2 = $object->string2;
echo 'Levenshtein Distance : ' . $object->editDistance($string1, $string2, strlen($string1), strlen($string2));
echo '<br>';
echo 'Hamming Distance : ' . $object->hammingDistance($string1, $string2);
echo '<br>';
echo 'Another way for Levenshtein Distance : ' . levenshtein($string1, $string2);
echo '<br>';
