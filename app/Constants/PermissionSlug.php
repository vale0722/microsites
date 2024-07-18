<?php
declare(strict_types=1);

namespace App\Constants;

final class PermissionSlug
{
    public const string CATEGORIES_VIEW_ANY = 'categories.view_any';
    public const string CATEGORIES_VIEW = 'categories.view';
    public const string CATEGORIES_CREATE = 'categories.create';
    public const string CATEGORIES_UPDATE = 'categories.update';
    public const string CATEGORIES_DELETE = 'categories.delete';

    public const string SITES_VIEW_ANY = 'sites.view_any';
    public const string SITES_VIEW = 'sites.view';
    public const string SITES_CREATE = 'sites.create';
    public const string SITES_UPDATE = 'sites.update';
    public const string SITES_DELETE = 'sites.delete';

    public static function toArray(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}
