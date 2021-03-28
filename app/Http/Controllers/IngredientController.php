<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    private $title = 'Ingredient';

    function list(Request $request)
    {
        function __construct() {
            $this->middleware('auth');
          } 
        $data = $request->getQueryParams();
        $query = Category::orderBy('code')->withCount('products');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
                return $innerQuery
                    ->where('code', 'LIKE', "%{$word}%")
                    ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }

        return view('category-list', [
            'title' => "{$this->title} : List",
            'term' => $term,
            'categories' => $query->paginate(5),
        ]);
    }
}
