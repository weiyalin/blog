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
    protected $table = 'tag';
    protected $fillable = ['name','user_id','rate'];
    static function create_tag_get_id($tag){
        $tag_id = Tag::where('name',$tag['name'])->where('user_id',$tag['user_id'])->value('id');
        if($tag_id){
            Tag::where('name',$tag['name'])->where('user_id',$tag['user_id'])->increment('rate');
            return $tag_id;
        }else{
            $tag = Tag::create($tag);
            return $tag->id;
        }
    }
    static function getTag(){
        return Tag::where('user_id',get_user_id())->get();
    }
}