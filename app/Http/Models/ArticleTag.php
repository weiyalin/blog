<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/10/11
 * Time: 21:28
 */

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use DB;
class ArticleTag extends Model
{
    static public function create_article_tag($at){
        $count = DB::table('article_tag')
            ->where('tag_id',$at['tag_id'])
            ->where('article_id',$at['article_id'])
            ->count();
        if(!$count){
            DB::table('article_tag')->insert($at);
        }
    }
}