<?php

namespace App;

class KrankenversichertennummerGenerator {
    public function generateKrankenversichertennummer() {
        $letters = range('A', 'Z');
        $letter = $letters[array_rand($letters)];
        $number = str_pad(mt_rand(1, 99999999), 8, '0', STR_PAD_LEFT);
        $checksum = $this->calculateChecksum($letter, $number);
        return $letter . $number . $checksum;
    }

    private function calculateChecksum($letter, $number) {
        $alphabet = range('A', 'Z');
        $alphabetWithKeys = array_combine(range(1, count($alphabet)), $alphabet);
        // convert prefix to number (A = 1, B = 2, ...)
        $numberInAlphabet = array_search($letter, $alphabetWithKeys);
        // split number into digits
        $array = str_split(str_pad($numberInAlphabet, 2, '0', STR_PAD_LEFT));

        $array = array_merge($array, str_split($number));
        $array = array_map('intval', $array);

        $sum = 0;
        for ($i = 0; $i < count($array); $i++) {
            $digit = $array[$i];
            if ($i % 2 == 0) {
                $sum += $digit;
            } else {
                $sum += $this->crossfoot($digit * 2);
            }
        }

        return $sum % 10;
    }

    private function crossfoot(int $num): int {
        $sum = 0;
        while ($num != 0) {
            $sum += $num % 10;
            $num = (int)($num / 10);
        }
        return $sum % 10;
    }
}


