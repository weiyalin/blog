<?php
/**
 * Created by PhpStorm.
 * User: weiyalin
 * Date: 2017/8/23
 * Time: 17:38
 */

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function get_menu(){
        return responseToJson(0, 'success', Menu::get_menu());
    }
}