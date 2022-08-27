<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoteItem extends Model
{
    use HasFactory;

    protected $table = "note_items";
    protected $guarded = [];

    /** Relations */

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }
}
