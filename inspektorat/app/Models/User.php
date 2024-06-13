<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function level()
    {
        // 1 user 1 level
        return $this->belongsTo(Level::class);
    }

    // public function lokasi()
    // {
    //     // 1 user 1 lokasi
    //     return $this->belongsTo(Lokasi::class);
    // }

    public function posts()
    {
        // 1 user n post
        return $this->hasMany(Post::class);
    }

    public function pages()
    {
        // 1 user n pages
        return $this->hasMany(Page::class);
    }

    public function sluggable(): array
    {
        return [
            'username' => [
                'source'    => 'name',
                'separator' => '',
                'maxLength' => 10
            ]
        ];
    }


    public static function getSection($slug)
    {
        return Section::where(['slug' => $slug, 'status' => 1])->first();
    }
}
