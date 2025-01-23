<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    /** @use HasFactory<\Database\Factories\ItemsFactory> */
    use HasFactory;

    protected $table = 'items';
    protected $guarded = ['id'];

    public static function getItemsPaginated($paginateBy = 5, $searchString = "")
    {
        $query = self::query();

        if ($searchString) {
            $query->where('title', 'like', '%' . $searchString . '%');
        }

        $items = $query->paginate($paginateBy);

        return response()->json([
            'data' => $items->items(),
            'current_page' => $items->currentPage(),
            'per_page' => $items->perPage(),
            'total' => $items->total(),
            'last_page' => $items->lastPage(),
            'next_page_url' => $items->nextPageUrl(),
            'prev_page_url' => $items->previousPageUrl()
        ]);
    }

}
