<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;

class TinTucConTroller extends Controller
{
     public function getDanhSach()
    {
        $tintuc = TinTuc::orderby('id','DESC')->get();
        return view('admin.TinTuc.danhsach',['tintuc'=>$tintuc]);
        // return view('admin.TheLoai.danhsach');
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.TinTuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
        // return view('admin.TheLoai.danhsach');
    }

    public function postThem(Request $request)
    {
        $this-> validate($request,
                ['LoaiTin'=> 'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required',
                ],
                ['LoaiTin.required'=>'chua nhap loai tin',
                'TieuDe.required'=>'chua nhap tieu de',
                'TieuDe.min'=> 'toi thieu 3 ki tu',
                'TieuDe.unique'=> 'tieu de da ton tai',
                'TomTat.required'=> ' chua nhap tom tat',
                'NoiDung.required'=> 'chua nhap noi dung',

                ]);
        $tintuc= new TinTuc;
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc ->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc-> idLoaiTin = $request->LoaiTin;
        $tintuc -> TomTat = $request-> TomTat;
        $tintuc -> NoiDung = $request -> NoiDung;
        $tintuc -> SoLuotXem = 0;

        if($request -> hasFile('Hinh')){
            $file= $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'pgn'){
                return redirect ('admin/TinTuc/them')->with('loi','sai dinh dang anh!');
            }

            $name = $file -> getClientOriginalName();

            $Hinh = str_random(5)."_". $name;
            while (file_exists("upload/tintuc".$Hinh)) {
                $Hinh = str_random(5)."_". $name;
            }
            $file -> move("upload/tintuc",$Hinh);
            $tintuc -> Hinh =$Hinh;
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect ('admin/TinTuc/them')->with('thongbao','success!');
        // // return view('admin.TheLoai.danhsach');
    }

    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id); 
    	

        return view('admin.TinTuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);
        // return view('admin.TheLoai.danhsach');
    }

     public function postSua(Request $request, $id)
    {
         $tintuc = TinTuc::find($id); 
        
        $this-> validate($request,
                ['LoaiTin'=> 'required',
                'TieuDe'=>'required|min:3|unique:TinTuc,TieuDe',
                'TomTat'=>'required',
                'NoiDung'=>'required',
                ],
                ['LoaiTin.required'=>'chua nhap loai tin',
                'TieuDe.required'=>'chua nhap tieu de',
                'TieuDe.min'=> 'toi thieu 3 ki tu',
                'TieuDe.unique'=> 'tieu de da ton tai',
                'TomTat.required'=> ' chua nhap tom tat',
                'NoiDung.required'=> 'chua nhap noi dung',

                ]);
        
        $tintuc ->TieuDe = $request->TieuDe;
        $tintuc ->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc-> idLoaiTin = $request->LoaiTin;
        $tintuc -> TomTat = $request-> TomTat;
        $tintuc -> NoiDung = $request -> NoiDung;
       

        if($request -> hasFile('Hinh')){
            $file= $request -> file('Hinh');
            $duoi = $file -> getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'pgn'){
                return redirect ('admin/TinTuc/them')->with('loi','sai dinh dang anh!');
            }

            $name = $file -> getClientOriginalName();

            $Hinh = str_random(5)."_". $name;
            while (file_exists("upload/tintuc".$Hinh)) {
                $Hinh = str_random(5)."_". $name;
            }
            $file -> move("upload/tintuc",$Hinh);
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc -> Hinh =$Hinh;
        }
        $tintuc->save();
        // return view('admin.TheLoai.danhsach');

        return redirect ('admin/TinTuc/sua/'.$id)->with('thongbao','success!');
    }

     public function getXoa($id)
    {
        $tintuc = tintuc::find($id);
        $tintuc-> delete();
        return redirect ('admin/TinTuc/danhsach')->with('thongbao','success!');
    }

}
