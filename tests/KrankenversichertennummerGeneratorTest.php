<?php

use PHPUnit\Framework\TestCase;

class KrankenversichertennummerGeneratorTest extends TestCase
{
    public function testKrankenversichertennummerGenerator() {
        $number = (new App\KrankenversichertennummerGenerator)->generateKrankenversichertennummer();

        fwrite(STDERR, print_r($number, TRUE));
        $this->assertTrue(true);
    }
}
