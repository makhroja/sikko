<?php

function active_class($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

function is_active_route($path)
{
    return call_user_func_array('Request::is', (array) $path) ? 'true' : 'false';
}

function show_class($path)
{
    return call_user_func_array('Request::is', (array) $path) ? 'show' : '';
}

function bulanOptions($bulanSaatIni = "")
{
    if ($bulanSaatIni == "") {
        $bulanSaatIni = date('n');
    }

    $namaBulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
    ];

    $options = '<option value="">Pilih Bulan</option>';

    foreach ($namaBulan as $nomorBulan => $nama) {
        $selected = $bulanSaatIni == $nomorBulan ? 'selected' : '';
        $options .= "<option value=\"$nomorBulan\" $selected>$nama</option>";
    }

    return $options;
}

function tahunOptions($startYear = null, $endYear = null, $currentYear = "")
{
    if ($currentYear == "") {
        $currentYear = date('Y');
    }

    $startYear = $startYear ?? $currentYear - 3;
    $endYear = $endYear ?? $currentYear + 3;

    $options = '';
    for ($year = $startYear; $year <= $endYear; $year++) {
        $selected = $year == $currentYear ? 'selected' : '';
        $options .= "<option value=\"$year\" $selected>$year</option>";
    }

    return $options;
}

function generateNoFaktur()
{
    $date = now();
    $formattedDate = $date->format('Y-m-d');
    $yearMonth = $date->format('my');

    $count = \App\Models\Tagihan::whereDate('created_at', $formattedDate)->count();
    $count += 1;

    $noFaktur = 'F-' . $yearMonth . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

    return $noFaktur;
}

function generateNoTagihan()
{
    $date = now();
    $formattedDate = $date->format('Y-m-d');
    $yearMonth = $date->format('my');

    $count = \App\Models\Tagihan::whereDate('created_at', $formattedDate)->count();
    $count += 1;

    $noFaktur = 'T-' . $yearMonth . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

    return $noFaktur;
}
