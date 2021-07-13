<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

function rupiah($angka)
{
    $data = "Rp " . number_format($angka, 2, ',', '.');
    return $data;
}
