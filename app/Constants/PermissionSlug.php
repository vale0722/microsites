<?php
declare(strict_types=1);

namespace App\Constants;

final class PermissionSlug
{
    public const CATEGORIES_VIEW_ANY = 'categories.view_any';
    public const CATEGORIES_VIEW = 'categories.view';
    public const CATEGORIES_CREATE = 'categories.create';
    public const CATEGORIES_UPDATE = 'categories.update';
    public const CATEGORIES_DELETE = 'categories.delete';

    public const SITES_VIEW_ANY = 'sites.view_any';
    public const SITES_VIEW = 'sites.view';
    public const SITES_CREATE = 'sites.create';
    public const SITES_UPDATE = 'sites.update';
    public const SITES_DELETE = 'sites.delete';

    public static function toArray(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
