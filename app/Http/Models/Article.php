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
    protected $table = 'articles';
    protected $fillable = ['copyright','title','coverName','summary','content','read_num','status','user_id','created_at','updated_at'];
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

    public function tags()
    {
        return $this->belongsToMany('App\Http\Models\Tag','article_tag','article_id','tag_id');
    }
}