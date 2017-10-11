<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/10/8
 * Time: 21:57
 */

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use App\Http\Models\ArticleTag;
use App\Http\Models\Tag;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class CreateController extends Controller
{
    function upload(Request $request){

        //判断请求中是否包含name=file的上传文件
        if (!$request->hasFile('files')) {
            return responseToJson(1, '上传文件为空！');
        }
        $file = $request->file('files');
        //判断文件上传过程中是否出错
        if (!$file->isValid()) {
            return responseToJson(2, '文件上传出错！');
        }
        $destPath = realpath(storage_path('app/cover'));
        if (!file_exists($destPath))
            mkdir($destPath, 0777, true);
        //$filename = $file->getClientOriginalName();
        $filename = get_user_id() . 'and' . millisecond().'.' . $file->getClientOriginalExtension();
        if ($file->move($destPath, $filename) == false) {
            return responseToJson(3, '保存文件失败！');
        }

        return responseToJson(0,'success',$filename);
    }

    function download_img(){
        $name = Input::get('name');
        $path = realpath(storage_path().'/app/cover/'.$name);
        return response()->download($path);
    }

    function create(){
        $id        = Input::get('id');
        $copyright = Input::get('copyright');
        $title     = Input::get('title');
        $coverName = Input::get('coverName');
        $content   = Input::get('content');
        $summary   = Input::get('summary');
        $status    = Input::get('status');
        $dynamicTags_select = Input::get('dynamicTags_select');

        $now = millisecond();

        $article = [
            'copyright'   => $copyright,
            'title'       => $title,
            'coverName'   => $coverName,
            'summary'     => $summary,
            'content'     => $content,
            'status'      => $status,
            'create_time' => $now,
            'update_time' => $now
        ];
        $article_id = Article::create_article_get_id($article,$id);
        if($article_id){
            foreach ($dynamicTags_select as $value){
                $tag = [
                    'name'    => $value['name'],
                    'user_id' => get_user_id(),
                ];
                $tag_id = Tag::create_tag_get_id($tag);
                ArticleTag::create_article_tag([
                    'tag_id'     => $tag_id,
                    'article_id' => $article_id
                ]);
            }
        }else{
            return responseToJson(1,'文章保存失败');
        }
    }
}