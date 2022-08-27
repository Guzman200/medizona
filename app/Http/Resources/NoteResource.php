<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'          => $this->id,
            'customer_id' => $this->customer_id,
            'date'        => $this->date,
            'total'       => $this->total,
            'customer'    => [
                'id'   => $this->customer->id,
                'name' => $this->customer->name
            ],
            'items' => $this->getItems($this->resource)
        ];

    }

    public function getItems($note)
    {
        $data = [];
        foreach($note->noteItems as $noteItem)
        {
            $data[] = [
                'id'       => $noteItem->item->id,
                //'item_id'  => $noteItem->item_id,
                'quantity' => $noteItem->quantity,
                'price'    => $noteItem->item->price,
                'total'    => ($noteItem->quantity * $noteItem->item->price),
                'name'     => $noteItem->item->name
            ];
        }

        return $data;
    }
}
