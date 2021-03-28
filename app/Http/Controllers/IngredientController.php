<?php

namespace App\Http\Controllers;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Ingredient;

class IngredientController extends Controller
{
    private $title = 'Ingredient';

    function list(Request $request)
    {
        function __construct() {
            $this->middleware('is_admin');
        } 
        $data = $request->getQueryParams();
        $query = Ingredient::orderBy('ingredient_code');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
                return $innerQuery
                    ->where('ingredient_code', 'LIKE', "%{$word}%")
                    ->orWhere('ingredient_name', 'LIKE', "%{$word}%");
            });
    }

        return view('ingredient-list', [
            'title' => "{$this->title} : List",
            'term' => $term,
            'ingredient' => $query->paginate(5),
        ]);
    }
}
