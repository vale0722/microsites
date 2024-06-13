<?php

namespace App\Actions\Sites;

use App\Models\Site;

class StoreAction
{
    public function execute(array $data): Site
    {
        $site = new Site();
        $site->category_id = $data['category_id'];
        $site->name = $data['name'];
        $site->document_type = $data['document_type'];
        $site->document = $data['document'];
        $site->enabled_at = now();
        $site->save();

        return $site;
    }
}
