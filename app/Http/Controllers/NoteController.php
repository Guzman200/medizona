<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Item;
use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{

    public function index()
    {

        $notes = Note::with(['customer'])->get();


        return response()->json($notes);
    }
    
    public function getItems()
    {

        $items = Item::get();

        return response()->json($items);
    }

    public function getCustomers()
    {
        $customers = Customer::get();

        return response()->json($customers);
    }
}
