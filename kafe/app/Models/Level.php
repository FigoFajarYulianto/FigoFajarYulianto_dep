<?php

namespace App\Models;

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function actionName($action)
    {
        $data = [
            [
                'id'        => 1,
                'action'    => 'index',
                'name'      => 'Grid View'
            ],
            [
                'id'        => 2,
                'action'    => 'create',
                'name'      => 'Form Add'
            ],
            [
                'id'        => 3,
                'action'    => 'edit',
                'name'      => 'Form Edit'
            ],
            [
                'id'        => 4,
                'action'    => 'show',
                'name'      => 'Detail'
            ],
            [
                'id'        => 5,
                'action'    => 'store',
                'name'      => 'Insert Data'
            ],
            [
                'id'        => 6,
                'action'    => 'update',
                'name'      => 'Update Data'
            ],
            [
                'id'        => 7,
                'action'    => 'destroy',
                'name'      => 'Delete Data'
            ],
            [
                'id'        => 8,
                'action'    => 'print_nota_penjualan',
                'name'      => 'Print Nota'
            ],
            [
                'id'        => 9,
                'action'    => 'export_xls',
                'name'      => 'Export XLS'
            ],
            [
                'id'        => 10,
                'action'    => 'export_pdf',
                'name'      => 'Export PDF'
            ],
            [
                'id'        => 11,
                'action'    => 'destroy_reply',
                'name'      => 'Hapus Pesan'
            ],
            [
                'id'        => 12,
                'action'    => 'scan',
                'name'      => 'Scan Whatsapp'
            ],
            [
                'id'        => 13,
                'action'    => 'auth',
                'name'      => 'Mendapatkan QR Whatsapp'
            ],
            [
                'id'        => 14,
                'action'    => 'reset',
                'name'      => 'Reset Whatsapp'
            ],
            [
                'id'        => 15,
                'action'    => 'resend',
                'name'      => 'Kirim Ulang Whatsapp'
            ],
            [
                'id'        => 16,
                'action'    => 'detail',
                'name'      => 'Detail Data'
            ]
        ];

        return collect($data)->where('action', $action)->first();
    }

    public static function routes()
    {
        $routeCollection = Route::getRoutes();
        $routes = [];
        foreach ($routeCollection as $value) {
            if ($value->uri()) {
                $nameExplode = explode('/', $value->uri());
                if (count($nameExplode) > 1 && $nameExplode[0] == 'dashboard') {
                    $routes[] = $value->getName();
                }
            }
        }
        return collect($routes)->sort()->values();
    }
}
