<?php

if (!function_exists('tanggalIndo')) {
    function tanggalIndo($tanggal)
    {
        // Set locale to Indonesian
        setlocale(LC_TIME, 'id_ID.UTF-8', 'Indonesian_indonesia.1252');
        return strftime('%d %B %Y', strtotime($tanggal));
    }
}
function hitunghari($tanggal_mulai, $tanggal_akhir)
{
    $tanggal_1 = date_create($tanggal_mulai);
    $tanggal_2 = date_create($tanggal_akhir);
    $diff = date_diff($tanggal_1, $tanggal_2);

    return $diff->days + 1;
}

function selisih($jam_masuk, $jam_keluar)
{
    // Default nilai jika salah satu atau kedua jam kosong
    if (empty($jam_masuk) || empty($jam_keluar)) {
        return '';
    }

    // Mengubah waktu menjadi array [jam, menit, detik]
    [$h_masuk, $m_masuk, $s_masuk] = explode(':', $jam_masuk);
    [$h_keluar, $m_keluar, $s_keluar] = explode(':', $jam_keluar);

    // Mengubah waktu menjadi timestamp dengan menggunakan mktime
    $dtAwal = mktime($h_masuk, $m_masuk, $s_masuk, 1, 1, 1970);
    $dtAkhir = mktime($h_keluar, $m_keluar, $s_keluar, 1, 1, 1970);

    // Menghitung selisih waktu dalam detik
    $dtSelisih = $dtAkhir - $dtAwal;

    // Mengubah selisih waktu menjadi jam dan menit
    $totalMenit = $dtSelisih / 60;
    $jam = floor($totalMenit / 60);
    $menit = $totalMenit % 60;

    // Mengembalikan hasil dalam format jam:menit
    return sprintf('%02d:%02d', $jam, round($menit));
}

function getDateRange($startDate, $endDate)
{
    $period = new DatePeriod(
        new DateTime($startDate),
        new DateInterval('P1D'),
        (new DateTime($endDate))->modify('+1 day')
    );

    $dates = [];
    foreach ($period as $date) {
        $dates[] = $date->format('Y-m-d');
    }

    return $dates;
}

function tanggalSingkat($tanggal)
{
    $bulanSingkat = [
        1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agus', 'Sep', 'Okt', 'Nov', 'Des'
    ];

    $tanggalArray = explode('-', $tanggal);

    if (count($tanggalArray) !== 3) {
        // Jika format tanggal tidak sesuai, kembalikan string kosong atau pesan error
        return " ";
    }

    $tahun = $tanggalArray[0];
    $bulan = (int)$tanggalArray[1];
    $hari = $tanggalArray[2];

    if ($bulan < 1 || $bulan > 12) {
        // Jika nilai bulan tidak valid, kembalikan string kosong atau pesan error
        return "Format bulan tidak valid";
    }

    return $hari . ' ' . $bulanSingkat[$bulan] . ' ' . $tahun;
}

if (!function_exists('tanggalBulanTahun')) {
    function tanggalBulanTahun($date)
    {
        return date('F Y', strtotime($date));
    }
}
