<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class GetPetsListController extends Controller
{
    public function __invoke()
    {
        $search = request()->query('search', '');
        $items = Items::getItemsPaginated(5, $search);

        return response()->json($items, 200);
    }
}
