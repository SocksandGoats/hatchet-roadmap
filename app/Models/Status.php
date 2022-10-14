<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Status extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public static function getCount()
    {
        // get the count of ideas for each status and all statuses
        $statusCount = self::withCount('ideas')->get()->mapWithKeys(function ($item) {
            return [strtolower($item['name']) => $item['ideas_count']];
        });
        return $statusCount->merge(['All' => $statusCount->sum()]);
    }
}
