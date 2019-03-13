<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TheLoai;
use App\LoaiTin;
use App\TinTuc;


class PagesController extends Controller
{

	 function __construct(){
    	$theloai = TheLoai::all();
    	view()-> share ('theloai',$theloai);
    }
    function trangchu(){
    	
    	return view('pages.trangchu');
    }

    function lienhe(){
    		
    	return view('pages.lienhe');


    }

    function loaitin($id){
    		$loaitin= LoaiTin::find($id);
    		$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin',['loaitin'=>$loaitin,'tintuc'=>$tintuc]);
    }

    function tintuc($id){
    		$tintuc= TinTuc::find($id);
    		//$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    		$tinnoibat = TinTuc::where('NoiBat',0)->take(4)->get();
    		$tinlienquan= TinTuc::where('idLoaiTin',$tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc',['tintuc'=>$tintuc, 'tinnoibat'=>$tinnoibat,'tinlienquan'=>$tinlienquan]);
    }
}


