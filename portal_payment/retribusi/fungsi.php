<?php
// format denda
function dateDiff($interval, $dateTimeBegin, $dateTimeEnd)
{
    //Parse about any English textual datetime
    //$dateTimeBegin, $dateTimeEnd

    $dateTimeBegin = strtotime($dateTimeBegin);
    if ($dateTimeBegin === -1) {
        return ("..begin date Invalid");
    }

    $dateTimeEnd = strtotime($dateTimeEnd);
    if ($dateTimeEnd === -1) {
        return ("..end date Invalid");
    }

    $dif = $dateTimeEnd - $dateTimeBegin;

    switch ($interval) {
        case "s": //seconds
            return ($dif);

        case "n": //minutes
            return (floor($dif / 60)); //60s=1m

        case "h": //hours
            return (floor($dif / 3600)); //3600s=1h

        case "d": //days
            return (floor($dif / 86400)); //86400s=1d

        case "ww": //Week
            return (floor($dif / 604800)); //604800s=1week=1semana

        case "m": //similar result "m" dateDiff Microsoft
            $monthBegin = (date("Y", $dateTimeBegin) * 12) +
                date("n", $dateTimeBegin);
            $monthEnd = (date("Y", $dateTimeEnd) * 12) +
                date("n", $dateTimeEnd);
            $monthDiff = $monthEnd - $monthBegin;
            return ($monthDiff);

        case "yyyy": //similar result "yyyy" dateDiff Microsoft
            return (date("Y", $dateTimeEnd) - date("Y", $dateTimeBegin));

        default:
            return (floor($dif / 86400)); //86400s=1d
    }
}

function datediff1($tgl1, $tgl2)
{
    $tgl1 = strtotime($tgl1);
    $tgl2 = strtotime($tgl2);
    $diff_secs = abs($tgl1 - $tgl2);
    $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
    $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

    return array("years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int) date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int) date("s", $diff));
}

//tanggal jatuh tempo = tgl satu bulan berikutnya
//misal kalo masa pajak 01/09/2016 ketika dibayar tgl 1/10/2016 dah kena pajak 2 %

function denda($tgl_jatuh_tempo_sppt, $tgl_bayar, $spt_pajak)
{

    if (empty($tgl_bayar)) $tgl_bayar = date('Y/m/d');

    $hari = intval(dateDiff("d", $tgl_jatuh_tempo_sppt, $tgl_bayar));

    $a =  datediff1($tgl_jatuh_tempo_sppt, $tgl_bayar);

    $v_jml_tahun = $a['years'];
    $v_jml_bulan = $a['months'];
    $v_jml_hari = $a['days'];

    $explode_jatuh_tempo = explode('-', $tgl_jatuh_tempo_sppt);
    $tahun_jatuh_tempo = $explode_jatuh_tempo[0];
    $bulan_jatuh_tempo = $explode_jatuh_tempo[1];

    if ($hari <= 0) {
        $v_denda = "0";
    } else {
        if ($tahun_jatuh_tempo >= '2024' && $bulan_jatuh_tempo >= '02') {
            if ($v_jml_tahun >= 2) {
                $v_denda = 24 * 1 / 100 * $spt_pajak;
            } else if ($v_jml_tahun < 2) {
                //if($v_jml_tahun == 1 && $v_jml_bulan==0 && $v_jml_hari==0){
                if ($v_jml_tahun == 1) {
                    $v_jml_bulan = $v_jml_bulan + 12;

                    if ($v_jml_hari > 0) {
                        $v_jml_bulan = $v_jml_bulan + 1;

                        $v_denda = $v_jml_bulan * 1 / 100 * $spt_pajak;
                    } else {

                        $v_denda = $v_jml_bulan * 1 / 100 * $spt_pajak;
                    }
                } else {
                    if ($v_jml_hari >= 1) {
                        $v_jml_bulan = $v_jml_bulan + 1;

                        $v_denda = $v_jml_bulan * 1 / 100 * $spt_pajak;
                    } else {

                        $v_denda = $v_jml_bulan * 1 / 100 * $spt_pajak;
                    }
                }
            }
        }else{
            if ($v_jml_tahun >= 2) {
                $v_denda = 24 * 2 / 100 * $spt_pajak;
            } else if ($v_jml_tahun < 2) {
                //if($v_jml_tahun == 1 && $v_jml_bulan==0 && $v_jml_hari==0){
                if ($v_jml_tahun == 1) {
                    $v_jml_bulan = $v_jml_bulan + 12;

                    if ($v_jml_hari > 0) {
                        $v_jml_bulan = $v_jml_bulan + 1;

                        $v_denda = $v_jml_bulan * 2 / 100 * $spt_pajak;
                    } else {

                        $v_denda = $v_jml_bulan * 2 / 100 * $spt_pajak;
                    }
                } else {
                    if ($v_jml_hari >= 1) {
                        $v_jml_bulan = $v_jml_bulan + 1;

                        $v_denda = $v_jml_bulan * 2 / 100 * $spt_pajak;
                    } else {

                        $v_denda = $v_jml_bulan * 2 / 100 * $spt_pajak;
                    }
                }
            }
        }
    }

    $v_denda = round($v_denda);

    return ($v_denda);
}

//format tanggal
if (!function_exists('tgl_indo')) {
    function date_indo($tgl)
    {
        $ubah = gmdate($tgl, time() + 60 * 60 * 8);
        $pecah = explode("-", $ubah);
        $tanggal = $pecah[2];
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        return $tanggal . ' ' . $bulan . ' ' . $tahun;
    }
}

if (!function_exists('bulan')) {
    function bulan($bln)
    {
        switch ($bln) {
            case 1:
                return "Januari";
                break;
            case 2:
                return "Februari";
                break;
            case 3:
                return "Maret";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "Mei";
                break;
            case 6:
                return "Juni";
                break;
            case 7:
                return "Juli";
                break;
            case 8:
                return "Agustus";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "Oktober";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "Desember";
                break;
        }
    }
}

//generate va
function getVA($data) {
    $url = 'http://192.168.1.20/api_va_retribusi/request_billing';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
    "Content-Type: multipart/form-data",
    "Access-Control-Allow-Methods: POST",
    );

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);
    // var_dump($resp);
    return json_decode($resp);
}
