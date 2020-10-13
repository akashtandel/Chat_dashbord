<?php

include("testing_1.php");
//echo('Subject_1_SK:'.$subject_1_SK.'<br />');
//echo('Subject_2_SK:'.$subject_2_SK);
if($subject_1_SK==$subject_2_SK)
{
	$num=$subject_1_SK;
}
else
{
	echo "wrong key";
}
function sum($num) { 
    $sum = 0; 
    for ($i = 0; $i < strlen($num); $i++){ 
        $sum += $num[$i]; 
    } 
    return $sum; 
} 
  
// Driver Code 
//$num = "115"; 
$shift=sum($num)."<br>"; 
$deshift=46-sum($num)."<br>";
//echo "<br>".$num."<br>";
function str_rot($string, $rot=23)
{
    $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz1!2@3#4$5%6^7&8*9(0)~`{[}]|\:;?/>.<,-_=+';
    // "% 26" allows numbers larger than 26
    // doubled letters = double rotated
    $dbl_rot = ((int) $rot % 46) * 2;
    if($dbl_rot == 0) { return $string; }
    // build shifted letter map ($dbl_rot to end + start to $dbl_rot)
    $map = substr($letters, $dbl_rot) . substr($letters, 0, $dbl_rot);
    // strtr does the substitutions between $letters and $map
    return strtr($string, $letters, $map);
}
echo $string="AKASHKUMAR ASHVINBHAI TANDEL";
echo "<br>encryprtion is:   ";
echo $enc=str_rot($string,$shift)."<br>";
echo "decryption is:    ";
echo $dec=substr(str_rot($enc,$deshift), 0, -4);
//echo str_rot("Experience is the teacher of all things.", 3);
// Hashulhqfh lv wkh whdfkhu ri doo wklqjv.
?>