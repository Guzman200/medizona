<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function search(Request $request)
    {

        if($request->search == ""){
            return response()->json([]);
        }

        $items = Item::where('name', 'like', "%$request->search%")->orWhere('sku', 'like', "%$request->search%")->take(5)->get();

        return response()->json($items);

    }
}
