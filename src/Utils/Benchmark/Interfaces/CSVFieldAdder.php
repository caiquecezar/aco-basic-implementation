<?php

namespace App\Utils\Benchmark\Interfaces;

interface CSVFieldAdder
{
    public function getAdditionalHeaders(): string;
    public function getAdditionalContent(): string;
}
