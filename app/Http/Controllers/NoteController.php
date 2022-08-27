<?php

namespace App\Http\Controllers;

use App\Http\Requests\Note\StoreNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Note;
use App\Models\NoteItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{

    public function index()
    {

        $notes = Note::with(['customer'])->get();

        return response()->json($notes);
    }

    public function show(Note $note)
    {
        return response()->json(new NoteResource($note));
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

    public function store(StoreNoteRequest $request)
    {

        DB::transaction(function () use ($request) {

            $note = new Note();
            $note->customer_id = $request->customer_id;
            $note->date = $request->date;
            $note->total = $request->total;
            $note->save();

            foreach($request->items as $item)
            {
                $note_item = new NoteItem();
                $note_item->note_id = $note->id;
                $note_item->item_id = $item['id'];
                $note_item->quantity = $item['quantity'];
                $note_item->total = $item['total'];
                $note_item->save();
            }

            
        });

        return response()->json([],200);

        

    }

    public function update(StoreNoteRequest $request, Note $note)
    {

        DB::transaction(function () use ($request, $note) {

            $note->customer_id = $request->customer_id;
            $note->date  = $request->date;
            $note->total = $request->total;
            $note->update();

            NoteItem::where('note_id', $note->id)->delete();

            foreach($request->items as $item)
            {
                $note_item = new NoteItem();
                $note_item->note_id = $note->id;
                $note_item->item_id = $item['id'];
                $note_item->quantity = $item['quantity'];
                $note_item->total = $item['total'];
                $note_item->save();
            }

            
        });

        return response()->json([],200);

        

    }

    public function destroy(Note $note)
    {
        NoteItem::where('note_id', $note->id)->delete();
        $note->delete();

        return response()->json([], 200);
    }

}
