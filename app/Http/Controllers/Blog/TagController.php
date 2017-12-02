<?php

namespace App\Http\Controllers\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Tag;

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
}
