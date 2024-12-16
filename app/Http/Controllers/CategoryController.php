<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\SeoPageTrait;

class CategoryController extends Controller
{
    use SeoPageTrait;

    public function show(Category $category)
    {
        $courses = $category->courses()->paginate(10);

        //dd($category->description);

        /**
         * seotools : https://github.com/artesaos/seotools
         */
        $this->generateShowSeoPage('category', $category);

        return view('categories.show', compact('category', 'courses'));
    }
}
