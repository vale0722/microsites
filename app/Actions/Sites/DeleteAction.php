<?php

namespace App\Actions\Sites;

use App\Models\Site;

class DeleteAction
{
    public function execute(Site $site): void
    {
        $site->delete();
    }
}
