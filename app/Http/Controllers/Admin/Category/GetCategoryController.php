<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class GetCategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($section_id)
    {
        $section     = Section::findOrFail($section_id);

        return $section->parentCategories;
    }
}