<?php
$hostname = "localhost";
$database = "siprida";
$username = "postgres";
$password = "D4t4bumi2019";
$port     =  "5432";
$connect = pg_connect("host=$hostname port=$port dbname=$database user='$username'
password='$password'");
// script cek koneksi   
if (!$connect) {
    die("Koneksi Tidak Berhasil");
}
