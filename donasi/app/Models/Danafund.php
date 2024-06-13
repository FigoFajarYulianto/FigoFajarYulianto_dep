<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danafund extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function dana()
    {
        return $this->belongsTo(Dana::class)->with('danacategory');
    }

    public function danacategory()
    {
        return $this->belongsTo(Danacategory::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['dana'] ?? false,
            fn ($query, $dana) => $query->where('dana_id', $dana)
        );

        $query->when(
            $filters['danacategory'] ?? false,
            fn ($query, $danacategory) => $query->where('danacategory_id', $danacategory)
        );

        $query->when(
            $filters['name'] ?? false,
            fn ($query, $search) => $query
                ->whereRelation('dana', 'name', 'like', '%' . $search . '%')
        );
    }
}
