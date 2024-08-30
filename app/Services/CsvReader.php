<?php

namespace App\Services;

use App\Constants\Delimiter;
use Generator;

use function is_array;

class CsvReader
{
    protected $file;

    private Delimiter $delimiter;

    public function __construct(string $filePath, Delimiter $delimiter = Delimiter::COMMA)
    {
        $this->delimiter = $delimiter;
        $this->file = fopen($filePath, 'r');
    }

    /**
     * @return Generator<int, array>
     */
    public function rows(): Generator
    {
        while (! feof($this->file)) {
            $row = fgetcsv(
                $this->file,
                4096,
                $this->delimiter->value
            );

            if (is_array($row)) {
                yield $row;
            }
        }
    }
}
