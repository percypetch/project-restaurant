<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $title = 'Category';

    function list() {
        return view('category-list', [
            'title' => "{$this->title} : List",
            'categories' => Category::orderBy('category_code')->get(),
        ]);
    }

    function show($categoryCode) {
        $category = Category::where('category_code', $categoryCode)->firstOrFail();
        
        return view('category-view', [
            'title' => "{$this->title} : View",
            'category' => $category,
        ]);
    }
}
