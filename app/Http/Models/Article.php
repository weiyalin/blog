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
    protected $table = 'article';
    protected $fillable = ['copyright','title','coverName','summary','content','read_num','status'];
    static function create_article_get_id($article,$id = 0){
        if($id){
            $count = Article::where('id',$id)->count();
            if($count){
                Article::update($article);
                return $id;
            }
        }
        $article = Article::create($article);
        return $article->id;
    }
}