<?php 
/*
 * Get PI value up to X decimal numbers
 * Make sure bcmath install on you server. Install on linux run this command sudo apt-get install php-bcmath
 * Source: http://mgccl.com/2007/01/22/php-calculate-pi-revisited
 */

function bcfact($n){
    return ($n == 0 || $n== 1) ? 1 : bcmul($n,bcfact($n-1));
}

function bcpi($precision){
    $num = 0;$k = 0;
    bcscale($precision+3);
    $limit = ($precision+3)/14;
    while($k < $limit)
    {
        $num = bcadd($num, bcdiv(bcmul(bcadd('13591409',bcmul('545140134', $k)),bcmul(bcpow(-1, $k), bcfact(6*$k))),bcmul(bcmul(bcpow('640320',3*$k+1),bcsqrt('640320')), bcmul(bcfact(3*$k), bcpow(bcfact($k),3)))));
        ++$k;
    }
    return bcdiv(1,(bcmul(12,($num))),$precision);
}

//Function calling
$decimalVal = (isset($_GET['decimal']) && $_GET['decimal'] > 0) ? $_GET['decimal'] : 2;
echo bcpi($decimalVal);
?>