<?php
function slug($s)
{
    $c = array(' ');
    $d = array('-', '/', '\\', ',', '.', '#', ':', ';', '\'', '"', '[', ']', '{', '}', ')', '(', '|', '`', '~', '!', '@', '%', '$', '^', '&', '*', '=', '?', '+');

    $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d

    $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
    return $s;
}
function dead($data)
{
    echo '<pre class="-debug">';
    print_r($data);
    echo '</pre>' . "\n";
    die();
}
function get_hash($PlainPassword)
{
    $option = [
        'cost' => 5, // proses hash sebanyak: 2^5 = 32x
    ];
    return password_hash($PlainPassword, PASSWORD_DEFAULT, $option);
}
function anti_injection($data)
{
    $filter = stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES)));
    return $filter;
}
function hash_verified($PlainPassword, $HashPassword)
{
    return password_verify($PlainPassword, $HashPassword) ? true : false;
}
