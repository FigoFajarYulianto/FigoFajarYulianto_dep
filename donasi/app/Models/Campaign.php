<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Campaign extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'    => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

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

    public function galeries()
    {
        return $this->hasMany(Galery::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function campaign_fund()
    {
        return $this->belongsTo(Campaignfund::class, 'id', 'campaign_id');
    }

    public function campaign_fund_items()
    {
        return $this->hasMany(Campaignfunditem::class)->latest();
    }

    public function fund()
    {
        return $this->belongsTo(Fund::class);
    }

    public function fund_items()
    {
        return $this->hasMany(Funditem::class);
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
            fn ($query, $status) => $query->where('status_id', $status)
        );

        $query->when(
            $filters['name'] ?? false,
            fn ($query, $search) => $query
                ->where('title', 'like', '%' . $search . '%')
        );

        $query->when(($filters['startdate'] ?? false) && ($filters['enddate'] ?? false) ? [$filters['startdate'], $filters['enddate']] : false,
            fn ($query, $dates) => $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $dates[0]))
                ->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $dates[1]))
        );
    }
}
