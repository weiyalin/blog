<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/10/12
 * Time: 21:15
 */

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    // 登陆判断
    public static function get_account($loginName)
    {
        $result = DB::table('user')
            ->where('name', $loginName)
            ->orWhere('mobile', $loginName)
            ->first();
        return $result;
    }

    public static function reset($user){
        DB::table('user')
            ->where('id', $user['id'])
            ->update($user);
    }
}