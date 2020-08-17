<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PB_Pages;


class PageController extends Controller
{
    public function showView()
    {
        $pb_PagesModelRef = new PB_Pages();

        $pages = $pb_PagesModelRef->getPagesWithTranslations(null, app()->getLocale())->select([
            'pagebuilder__pages.id',
            'pagebuilder__page_translations.title',
            'pagebuilder__pages.layout',
            'pagebuilder__page_translations.route',
            'pagebuilder__page_translations.locale'
        ])->get();

        return view('adminPanel/pages', compact('pages'));
    }

    public function deletePage($pageId)
    {
        $pb_PagesModelRef = new PB_Pages();

        $pb_PagesModelRef->getPagesWithTranslations($pageId)->delete();

        return redirect()->back()->with('message',trans('pages.pageDeleted'));
    }
}
