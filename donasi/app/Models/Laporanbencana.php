<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laporanbencana extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function subdistrict()
    {
        return $this->belongsTo(Subdistrict::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['province'] ?? false,
            fn ($query, $province) => $query->where('province_id', $province)
        );

        $query->when(
            $filters['district'] ?? false,
            fn ($query, $district) => $query->where('district_id', $district)
        );

        $query->when(
            $filters['subdistrict'] ?? false,
            fn ($query, $subdistrict) => $query->where('subdistrict_id', $subdistrict)
        );

        $query->when(
            $filters['status'] ?? false,
            fn ($query, $status) => $query->where('status', $status)
        );

        $query->when(
            $filters['name'] ?? false,
            fn ($query, $search) => $query
                ->where('kejadian', 'like', '%' . $search . '%')
        );

        $query->when(($filters['startdate'] ?? false) && ($filters['enddate'] ?? false) ? [$filters['startdate'], $filters['enddate']] : false,
            fn ($query, $dates) => $query->whereDate('tanggal', '>=', Carbon::createFromFormat('Y-m-d', $dates[0]))
                ->whereDate('tanggal', '<=', Carbon::createFromFormat('Y-m-d', $dates[1]))
        );
    }
}
