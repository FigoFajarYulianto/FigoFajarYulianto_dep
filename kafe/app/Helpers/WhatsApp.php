<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class WhatsApp
{

    public static function auth()
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/auth/getqr');
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function reset()
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/auth/restart');
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }


    public static function isregistered($number)
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/contact/isregistereduser/' . $number);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    // contact
    public static function contacts()
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/contact/getcontacts');
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function contact($number)
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/contact/getcontact/' . $number);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function profilepicture($number)
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/contact/getprofilepic/' . $number);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    // // chat
    public static function sendmessage($number, $message)
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/chat/sendmessage/' . $number, [
                    'message' => $message
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function sendmedia($number, $fileUrl, $caption = '')
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/chat/sendmedia/' . $number, [
                    'caption' => $caption,
                    'file' => $fileUrl,
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function sendlocation($number, $latitude, $longitude, $description = '')
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/chat/sendlocation/' . $number, [
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    'description'   => $description
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    // group
    public static function groupsendmessage($groupName, $message)
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/group/sendmessage/' . urlencode($groupName), [
                    'message'   => $message
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function groupsendmedia($groupName, $fileUrl, $caption = '')
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/group/sendmedia/' . urlencode($groupName), [
                    'file'      => $fileUrl,
                    'caption'   => $caption
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function groupsendlocation($groupName, $latitude, $longitude, $description = '')
    {
        try {
            $response = Http::asForm()
                ->post(env('API_WHATSAPP') . '/group/sendlocation/' . urlencode($groupName), [
                    'latitude'      => $latitude,
                    'longitude'     => $longitude,
                    'description'   => $description
                ]);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    // optional
    public static function chats()
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/chat/getchats');
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }

    public static function chat($number)
    {
        try {
            $response = Http::get(env('API_WHATSAPP') . '/chat/getchatbyid/' . $number);
            return $response->json();
        } catch (\Throwable $th) {
            return false;
        }
    }
}
