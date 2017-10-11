<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/10/11
 * Time: 16:47
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use DB;
class Tag extends Model
{
    static function create_tag_get_id($tag){
        $tag_id = DB::table('tag')->where('name',$tag['name'])->where('user_id',$tag['user_id'])->value('id');
        if($tag_id){
            return $tag_id;
        }else{
            $tag['create_time'] = millisecond();
            return DB::table('tag')->insertGetId($tag);
        }
    }
}