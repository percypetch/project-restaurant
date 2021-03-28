<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Menu;

class MenuController extends Controller
{
    private $title = 'Menu';

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Menu::orderBy('menu_code')/*->withCount('shops')*/;
        $term = (key_exists('term', $data))? $data['term'] : '';

        foreach(preg_split('/\s+/', $term) as $word) {
            $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('menu_code', 'LIKE', "%{$word}%")
                    ->orWhere('menu_name', 'LIKE', "%{$word}%"); 
                });
            }
            
        return view('menu-list', [
            'term' => $term,
            'title' => "{$this->title} : List",
            //'menus' => $query->paginate(3),
        ]);
        }
}
