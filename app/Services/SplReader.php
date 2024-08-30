<?php

namespace App\Services;

use App\Constants\Delimiter;
use Generator;
use SplFileObject;

class SplReader
{
    protected SplFileObject $file;

    private Delimiter $delimiter;

    public function __construct(string $filePath, Delimiter $delimiter = Delimiter::COMMA)
    {
        $this->file = new SplFileObject($filePath);
        $this->file->setFlags(SplFileObject::READ_CSV);

        $this->delimiter = $delimiter;
    }

    /**
     * @return Generator<int, array>
     */
    public function rows(): Generator
    {
        while (! $this->file->eof()) {
            $row = $this->file->fgetcsv($this->delimiter->value);

            if (empty($row)) {
                break;
            }

            yield $row;
        }
    }
}
