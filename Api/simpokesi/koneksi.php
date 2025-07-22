<?php
date_default_timezone_set("Asia/Bangkok");

$hostname = "localhost";
$database = "DBSIMPATDA";
$username = "postgres";
$password = "Bapenda2021";
$port     =  "5432";
$connect = pg_connect("host=$hostname port=$port dbname=$database user='$username'
password='$password'");
// script cek koneksi   
if (!$connect) {
    die("Koneksi Tidak Berhasil");
}
