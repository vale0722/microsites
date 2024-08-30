<?php

namespace App\Validators;

use App\Constants\Currency;
use DateTime;

use function in_array;
use function is_numeric;

class InvoiceValidator
{
    protected array $errors = [];

    public function __construct()
    {
        $this->errors = [];
    }

    public function validate(array $row, int $line): void
    {
        $this->errors = [];

        if (! count($row) === 10) {
            $this->setError('Invalid expected rows', $line);
        }

        if (! isset($row['reference']) || ! $this->alphaNumDash($row['reference'], 1, 40)) {
            $this->setError('Invalid reference format', $line);
        }

        if (! isset($row['amount']) || ! is_numeric($row['amount'])) {
            $this->setError('Invalid amount format', $line);
        }

        if (! isset($row['currency']) || ! in_array($row['currency'], Currency::toArray(), true)) {
            $this->setError('Invalid currency format', $line);
        }

        if (! isset($row['customer_name']) || strlen($row['customer_name']) > 100) {
            $this->setError('Invalid customer name format', $line);
        }

        if (! isset($row['dni']) || ! is_numeric($row['dni'])) {
            $this->setError('Invalid dni format', $line);
        }

        if (! isset($row['description']) || strlen($row['description']) > 512) {
            $this->setError('Invalid description format', $line);
        }

        if (! isset($row['created_at']) || ! $this->isDate($row['created_at'])) {
            $this->setError('Invalid created_at format', $line);
        }

        if (! isset($row['expired_at']) || ! $this->isDate($row['expired_at'])) {
            $this->setError('Invalid expired_at format', $line);
        }
    }

    public function alphaNumSpace(string $value, int $minLength = 1, int $maxLength = 100): bool
    {
        preg_match('/^[A-Za-z0-9\s]{'.$minLength.','.$maxLength.'}$/', $value, $matched);

        return ! empty($matched);
    }

    public function alphaNumDash(string $value, int $minLength = 1, int $maxLength = 50): bool
    {
        $regex = '/^[a-zA-Z0-9\s_-]{'.$minLength.','.$maxLength.'}$/';

        preg_match($regex, $value, $matched);

        return ! empty($matched);
    }

    public function isDate(string $date, string $format = 'Y-m-d'): bool
    {
        $dateTime = DateTime::createFromFormat($format, $date);

        return $dateTime && $dateTime->format($format) === $date;
    }

    public function setError(string $error, int $line): void
    {
        $this->errors[] = "Line #{$line}, error: {$error}";
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function fails()
    {
        return ! empty($this->errors);
    }
}
