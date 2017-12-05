<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Tag;
use Log;

class TagController extends Controller
{
    function getTag(){
        
        $tagNames = Tag::getTag();
        $tags = [];
        if($tagNames){
            foreach ($tagNames as $tag){
                $tags[] = ['name' => $tag->name];
            }
        }
        return responseToJson(0,'查询成功',$tags);
    }
    function getTagList(Request $request){
        $per_page = intval($request->input('per_page', 10));
        $keyword  = $request->input('keyword');
        
        $query = Tag::where('user_id',get_user_id());
        if($keyword){
            $query = Tag::where('name', 'like', $keyword . '%');
        }
        $students = $query->orderBy('rate', 'desc')->paginate($per_page);
        
        return responseToJson(0,'查询成功',$students);
    }
    function deleteTag(Request $request){
        $id = intval($request->input('id'));
        if(Tag::destroy($id))
            return responseToJson(0,'删除成功');
        else
            return responseToJson(1,'删除失败');
    }
    function addTag(Request $request){
        $id = intval($request->input('id'));
        $name = $request->input('name');
        $count = Tag::where('name', $name)->count();
        if($count)
            return responseToJson(1,'标签名称重复');
        if($id){
            $count1 = Tag::where('id', $id)->count();
            if($count1){
                // \DB::connection()->enableQueryLog();
                Tag::where('id',$id)->update(['name'=>$name]);
                // $queries = \DB::getQueryLog();
                // Log::info($queries);
            }
            else
                return responseToJson(1,'标签不存在');
        }
        else
            Tag::create(['name'=>$name,'user_id'=>get_user_id(),'rate'=>0]);
        return responseToJson(0,'success');
    }
}
