<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\TheLoai; 

// use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Input;
// use Excel;

class TheLoaiController extends Controller
{
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.TheLoai.danhsach',['theloai'=>$theloai]);
        // return view('admin.TheLoai.danhsach');
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.TheLoai.them');
        // return view('admin.TheLoai.danhsach');
    }

    public function postThem(Request $request)
    {
        $this-> validate($request,
                ['Ten'=> 'required|min:3|max:100'
                ],
                ['Ten.required'=>'chua nhap ten the loai',
                'Ten.min'=>' toi thieu 3 ki tu',
                'Ten.max'=> 'toi da 100 ki tu'
                ]);
        $theloai= new TheLoai;
        $theloai ->Ten = $request->Ten;
        $theloai ->TenKhongDau = changeTitle($request->Ten);
        $theloai -> save();

        return redirect ('admin/TheLoai/them')->with('thongbao','success!');
        // return view('admin.TheLoai.danhsach');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::find($id);
        return view('admin.TheLoai.sua',['theloai'=>$theloai]);
        // return view('admin.TheLoai.danhsach');
    }

     public function postSua(Request $request, $id)
    {
        $theloai = TheLoai::find($id);
        $this-> validate($request,
                ['Ten'=> 'required|unique:TheLoai,Ten|max:100'
                ],
                ['Ten.required'=>'chua nhap ten the loai',
                'Ten.unique'=>' ten da ton tai',
                'Ten.max'=> 'toi da 100 ki tu'
                ]);
         $theloai ->Ten = $request->Ten;
        $theloai ->TenKhongDau = changeTitle($request->Ten);
        $theloai -> save();
        // return view('admin.TheLoai.danhsach');

        return redirect ('admin/TheLoai/sua/'.$id)->with('thongbao','success!');
    }

     public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai-> delete();
        return redirect ('admin/TheLoai/danhsach')->with('thongbao','success!');
    }

}
