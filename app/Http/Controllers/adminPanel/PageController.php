<?php

namespace App\Http\Controllers\adminPanel;

use DB;
use Exception;
use App\Models\PB_Pages;
use Illuminate\Http\Request;
use App\Exceptions\ValidationError;
use App\Models\PB_PageTranslations;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

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

        return redirect()->back()->with('message', trans('pages.pageDeleted'));
    }

    public function addPage(Request $request)
    {
        try {

            $rules = array(
                'pageName' => 'bail|required',
                'enTitle' => 'bail|required',
                'enRoute' => 'bail|required',
                'laTitle' => 'bail|required',
                'laRoute' => 'bail|required'
            );

            $messages = array(
                'pageName.required' => Lang::get('pageName.pageNameRequired'),
                'enTitle.required' => Lang::get('enTitle.enTitleRequired'),
                'enRoute.required' => Lang::get('enRoute.enRouteRequired'),
                'laTitle.required' => Lang::get('laTitle.laTitleRequired'),
                'laRoute.required' => Lang::get('laRoute.laRouteRequired'),
            );

            $validator = Validator::make($request->toArray(), $rules, $messages);

            if ($validator->fails()) {
                throw new ValidationError($validator->errors()->first());
            }
            $pb_PagesModelRef = new PB_Pages();
            $pb_PageTranslationsModelRef = new PB_PageTranslations();

            DB::beginTransaction();

            $pageId = $pb_PagesModelRef->insertGetId(['name' => '', 'layout' => 'master']);
            if (isEmpty($pageId)) {
                throw new Exception('Inserted Page Id not Found!');
            }
            $pb_PageTranslationsModelRef->insert(['page_id' => $pageId, 'locale' => 'en', 'title' => $request->input('enTitle'), 'route' => $request->input('enRoute')]);
            $pb_PageTranslationsModelRef->insert(['page_id' => $pageId, 'locale' => 'nl', 'title' => $request->input('laTitle'), 'route' => $request->input('laRoute')]);

            DB::commit();
            
            return redirect()->back()->with('message', Lang::get('pages.pageAddedSuccessfully'));
        } catch (ValidationError $e) {
            $error = ValidationException::withMessages([$e->getMessage()]);
            throw $error;
        } catch (Exception $e) {
            DB::rollback(); // rollback in case of any error
            
            if (IsAuthEnv()) { // If the current environment is needed Authentication. Then return custom message
                $error = ValidationException::withMessages(['Invalid Exception.']);
            } else { // If the current environment is not needed Authentication. Then return Exception message
                $error = ValidationException::withMessages([$e->getMessage()]);
            }
            throw $error;
        }
    }
}
