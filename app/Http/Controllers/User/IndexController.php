<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
 	function reg(){
 		return view('user/reg');
 	}  
 	function regdo(){
 		unset($_POST['_token']);
        //echo '<pre>';print_r($_POST);echo '</pre>';
        
        $url = 'http://admin.com/reg';
        $client=new Client();
        $response =$client->request('post',$url,['form_params'=>$_POST
        	]);
       	$json_data=$response->getBody();
       	$info=json_decode($json_data,true);
        if($info['errno']){
        	echo "错误信息:" .$info['msg']."正在跳转>>>>";
        	die;
        }  
 	}
 	function login(){
 		return view('user/login');
 	}
    function logindo(){
    	unset($_POST['_token']);
        //echo '<pre>';print_r($_POST);echo '</pre>';
        $url = 'http://admin.com/login';
        $client=new Client();
        $response =$client->request('post',$url,['form_params'=>$_POST
        	]);
       	$json_data=$response->getBody();
       	$info=json_decode($json_data,true);
        if($info['errno']){
        	echo "错误信息:" .$info['msg']."正在跳转>>>>";
        	die;
        }
        $uid=$info['data']['uid'];
        $token=$info['data']['token'];
        //将token保存至客户端 cookie中
        Cookie::queue('token',$token,600);
        Cookie::queue('uid',$uid,600);
        //登陆成功
        header('Refresh:2;url=/user/center');
        echo "登陆成功,正在跳转至个人中心";
    }
    function center(){
    	$token=Cookie::get('token');
    	$uid=Cookie::get('uid');
    	if(empty($token)||empty($uid)){
    		header('Refresh:2;url=/user/login');
    		echo "请先登陆,页面跳转中";die;
    	}
    	$url='http://admin.com/auth';
    	$client=new Client();
    	$response =$client->request('post',$url,['form_params'=>['uid=>$uid','token'=>$token]]);
        	
       	$json_data=$response->getBody();
       	$info=json_decode($json_data,true);
        if($info['errno']){
        	echo "错误信息:" .$info['msg'];
        	die;
        }
        echo "欢迎来到个人中心";
    }


}
