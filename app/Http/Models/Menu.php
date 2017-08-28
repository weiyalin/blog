<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/8/23
 * Time: 17:39
 */

namespace App\Http\Models;

use \Illuminate\Database\Eloquent\Model;
use DB;
class Menu extends Model
{

    static function get_menu()
    {
        $menus = self::get_format_menu();
        return self::format_menu($menus);
    }

    static function get_format_menu(){
        return DB::table('menu')
            ->where('type', 0)
            ->where('status', 0)
            ->orderBy('sort_factor')
            ->get();
    }

    private static function format_menu($menus)
    {
        $data = [];
        foreach ($menus as $v) {
            if ($v->depth == 1) {
                $data[$v->id] = $v;
            }
        }
        //使sort_factor起作用，分两次循环（仅用code排序时，循环一次就够了）
        foreach ($menus as $v) {
            if ($v->depth == 2) {
                $data[$v->pid]->children[] = $v;
            }
        }
        return array_values($data);
    }
}