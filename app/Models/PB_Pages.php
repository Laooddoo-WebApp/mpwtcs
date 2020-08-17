<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

require_once app_path() . '/Helpers/basic.php';

class PB_Pages extends Model
{
    protected $table = 'pagebuilder__pages';

    public function getPagesWithTranslations($pageId = null, $lang = null)
    {
        return $this->join(
            'pagebuilder__page_translations',
            'pagebuilder__page_translations.page_id',
            'pagebuilder__pages.id'
        )
            ->when(
                !isEmpty($pageId),
                function ($query) use ($pageId) {
                    return $query->where('pagebuilder__pages.id', $pageId);
                }
            )->when(
                !isEmpty($lang),
                function ($query) use ($lang) {
                    return $query->where('pagebuilder__page_translations.locale', $lang);
                }
            );
    }
}
