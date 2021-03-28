<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Category;

class CategoryController extends Controller
{
    private $title = 'Category';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Category::orderBy('category_code');
        $term = (key_exists('term', $data))? $data['term'] : '';
        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('category_code', 'LIKE', "%{$word}%")
                    ->orWhere('category_name', 'LIKE', "%{$word}%");
            });
        }

        return view('category-list', [
            'term' => $term,
            'categories' => $query->paginate(5),
            'title' => "{$this->title} : List",
        ]);
    }

    function show($categoryCode) {
        $category = Category::where('category_code', $categoryCode)->firstOrFail();

        return view('category-view', [
            'title' => "{$this->title} : View",
            'category' => $category,
        ]);
    }

    function createForm() {
        return view('category-create', [
            'title' => "{$this->title} : Create",
        ]);
    }
        
        function create(Request $request) {
            $category = Category::create($request->getParsedBody());
        
            return redirect()->route('category-list');
        }
}