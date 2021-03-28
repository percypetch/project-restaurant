<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Ingredient;

class MenuController extends Controller
{
    private $title = 'Menu';

    public function __construct() {
        $this->middleware('auth');
    }
    
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
            'menu' => $query->paginate(3),
        ]);
        }

        function show($menuCode=0,$categoryCode=0,$ingredientCode=0) {
            $menu = Menu::where('menu_code', $menuCode)->firstOrFail();
            $category = Category::where('category_code', $categoryCode)->firstOrFail();
            $ingredient = Ingredient::where('ingredient_code', $ingredientCode)->firstOrFail();
            return view('menu-view', [
                'title' => "{$this->title} : View",
                'menu' => $menu,
                'category' => $category,
                'ingredient' => $ingredient
            ]);
            }

            function createForm(Request $request) {
                $this->authorize('update',Menu::class);
                $category = Category::orderBy('category_code');
                $ingredient = Ingredient::orderBy('ingredient_code');
                return view('product-create', [
                  'title' => "{$this->title} : Create",
                  'category' => $categories->get(),
                  'ingredient' => $ingredient->get(),
                ]);
            }
        
            function create(Request $request) {
                $this->authorize('update',Menu::class);
        
                try 
                {
                    $data = $request->getParsedBody();
                    $menu = new Menu();
                    $menu->fill($data);
                    $menu->category()->associate($data['category']);
                    $menu->ingredient()->associate($data['ingredient']);
                    $menu->save();
        
                    return redirect()->route('menu-list')
                    ->with('status', "Menu {$menu->menu_code} was created.");
                 } 
        
                 catch(\Exception $excp) 
                 {
                    return back()->withInput()->withErrors([
                    'input' => $excp->getMessage(),
                    ]);
                }
              
            }
}
