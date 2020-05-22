<?php 
session_start();
// menghancurkan sesi
session_destroy();

echo "<script>alert('anda telah logout');</script>";
echo "<script>location='index.php';</script>";


?>