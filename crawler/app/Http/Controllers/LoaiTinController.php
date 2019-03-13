<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    
     public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.LoaiTin.danhsach',['loaitin'=>$loaitin]);
        // return view('admin.TheLoai.danhsach');
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        return view('admin.LoaiTin.them',['theloai'=>$theloai]);
        // return view('admin.TheLoai.danhsach');
    }

    public function postThem(Request $request)
    {
        $this-> validate($request,
                ['Ten'=> 'required|min:3|max:100',
                'TheLoai'=>'required'
                ],
                ['Ten.required'=>'chua nhap ten the loai',
                'Ten.min'=>' toi thieu 3 ki tu',
                'Ten.max'=> 'toi da 100 ki tu',
                'TheLoai'=> 'chua nhap the loai'
                ]);
        $loaitin= new LoaiTin;
        $loaitin ->Ten = $request->Ten;
        $loaitin ->TenKhongDau = changeTitle($request->Ten);
        $loaitin-> idTheLoai = $request->TheLoai;
        $loaitin -> save();

        return redirect ('admin/LoaiTin/them')->with('thongbao','success!');
        // return view('admin.TheLoai.danhsach');
    }

    public function getSua($id)
    {
    	$theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);

        return view('admin.LoaiTin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
        // return view('admin.TheLoai.danhsach');
    }

     public function postSua(Request $request, $id)
    {
        
        $this-> validate($request,
                ['Ten'=> 'required|unique:TheLoai,Ten|max:100',
                'TheLoai'=>'required'
                ],
                ['Ten.required'=>'chua nhap ten the loai',
                'Ten.unique'=>' ten da ton tai',
                'Ten.max'=> 'toi da 100 ki tu',
                'TheLoai'=> 'chua nhap the loai'
                ]);
        $loaitin= new LoaiTin;
         $loaitin = LoaiTin::find($id);

         $loaitin ->Ten = $request->Ten;
        $loaitin ->TenKhongDau = changeTitle($request->Ten);
        $loaitin ->idTheLoai = $request -> TheLoai;

        $loaitin -> save();
        // return view('admin.TheLoai.danhsach');

        return redirect ('admin/LoaiTin/sua/'.$id)->with('thongbao','success!');
    }

     public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin-> delete();
        return redirect ('admin/LoaiTin/danhsach')->with('thongbao','success!');
    }

}

// ?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\LoaiTin;
// use App\TheLoai;

// class AjaxController extends Controller
// {
    
//      public function getLoaiTin($idTheLoai)
//     {
//         $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)-> get();
         
//         foreach($loaitin as $lt){
//          echo   "<option value='".$lt->id."'>".$lt->Ten." </option>";
//         }

// }
// }
// ?>