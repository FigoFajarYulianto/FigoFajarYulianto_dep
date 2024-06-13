<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Http;

class ApiPPID
{

    public static function getNews()
    {

        $result = collect([]);
        $result->push(ApiPPID::kec());
        // $result->push(ApiPPID::antirogo());
        // $result->push(ApiPPID::karangrejo());
        // $result->push(ApiPPID::kebonsari());
        // $result->push(ApiPPID::kranjingan());
        // $result->push(ApiPPID::sumbersari());
        // $result->push(ApiPPID::tegalgede());
        // $result->push(ApiPPID::wirolegi());

        $data = collect([]);
        foreach ($result->all() as $arrays) {
            foreach ($arrays as $item) {
                $data[] = $item;
            }
        }

        $sorted = $data->sortByDesc('created_at');
        return $sorted->values()->all();
    }

    public static function kec()
    {
        try {
            $response = Http::get(env('API_PPID'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function antirogo()
    {
        try {
            $response = Http::get(env('API_PPID_ANTIROGO'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function karangrejo()
    {
        try {
            $response = Http::get(env('API_PPID_KARANGREJO'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function kebonsari()
    {
        try {
            $response = Http::get(env('API_PPID_KEBONSARI'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function kranjingan()
    {
        try {
            $response = Http::get(env('API_PPID_KRANJINGAN'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function sumbersari()
    {
        try {
            $response = Http::get(env('API_PPID_SUMBERSARI'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function tegalgede()
    {
        try {
            $response = Http::get(env('API_PPID_TEGALGEDE'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }

    public static function wirolegi()
    {
        try {
            $response = Http::get(env('API_PPID_WIROLEGI'));
            $ppid = $response->json()['data'];
        } catch (\Throwable $th) {
            $ppid = [];
        }
        return $ppid;
    }
}
