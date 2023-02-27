<?php
/**
 * Created by PhpStorm.
 * User: Asim Raza
 * Date: 02/06/2021
 * Time: 11:29 PM
 */

namespace App\Helpers;

use Hashids\Hashids;

class FakerURL
{
    public static function id_e($id = 'id') {
        $hashId = new Hashids(md5(config('app.hash')));
        return $hashId->encode($id);
    }

    public static function id_d($value) {

        $hashId = new Hashids(md5(config('app.hash')));
        $decoded = $hashId->decode($value);
        if (is_array($decoded) && isset($decoded[0])) {
            return $decoded[0];
        }
        if (!$decoded) {
            // so 404 shows up in case of wrong id
            return -9999999999;
        }
        return $decoded;
    }

}