<?php

namespace App\Utils\Benchmark\Outputs;

use App\Utils\Benchmark\Interfaces\CSVFieldAdder;
use App\Utils\Benchmark\Interfaces\Handable;

class CsvHandler implements Handable
{
    private string $filePath;
    private $fileHandler;

    public function __construct(
        private string $class,
        private float $averageResult,
        private float $averageTime,
        private int $bestResult,
        private object $object,
    ) {
        $timestamp = time();
        $this->filePath = "outputs/{$this->class}-{$timestamp}.csv";
    }

    public function handle(): void
    {
        $this->open();
        $content = $this->content();
        fwrite($this->fileHandler, $content);
        $this->close();
    }

    public function open(): void
    {
        if (!is_dir('outputs') && !mkdir('outputs', 0777, true)) {
            //erro
        }

        $this->fileHandler = fopen($this->filePath, 'w');
        $content = $this->headers();
        fwrite($this->fileHandler, $content);
    }

    public function close(): void
    {
        fclose($this->fileHandler);
    }

    private function headers(): string
    {
        if ($this->object instanceof CSVFieldAdder) {
            return 'averageTime;averageResult;bestResult;' . $this->object->getAdditionalHeaders() . "\n";
        }

        return "averageTime;averageResult;bestResult\n";
    }

    private function content(): string
    {
        if ($this->object instanceof CSVFieldAdder) {
            return "{$this->averageTime};{$this->averageResult};{$this->bestResult};" . $this->object->getAdditionalContent() . "\n";
        }

        return "{$this->averageTime};{$this->averageResult};{$this->bestResult}\n";
    }
}
