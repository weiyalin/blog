<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/10/11
 * Time: 16:32
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use DB;
class Article extends Model
{
    static function create_article_get_id($article,$id = 0){
        if($id){
            $count = DB::table('article')->where('id',$id)->count();
            if($count){
                DB::table('article')->update($article);
                return $id;
            }
        }
        return DB::table('article')->insertGetId($article);
    }
}