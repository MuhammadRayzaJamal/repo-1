<?php
//fungi untuk normalisasi matriks keputusan
function normalisasi($value, $arrayValue, $sifat) {
    if (empty($arrayValue)) return 0; // cek array kosong

    if ($sifat == 'Benefit') {
        $max = max($arrayValue);
        return $max != 0 ? round($value / $max, 3) : 0;
    } elseif ($sifat == 'Cost') {
        $min = min($arrayValue);
        return $value != 0 ? round($min / $value, 3) : 0;
    }
    return 0;
}
