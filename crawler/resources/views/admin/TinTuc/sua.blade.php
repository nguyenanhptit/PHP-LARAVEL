@extends('layouts.adminLayout.admin_design')

@section('content')

<!-- Page Content -->

<div id="content">
  <div class="container-fluid">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loai Tin
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                      
                      @if(count($errors)>0)
                        <div class="alert alert-danger">
                          @foreach($errors->all() as $err)
                          {{$err}}<br>
                          @endforeach
                        </div>
                      @endif

                      @if(session('thongbao'))
                      <div class="alert alert-success">
                        {{session('thongbao')}}
                        </div>
                      @endif


                        <form action="admin/TinTuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                           

                           <div class="form-group">
                                <label>The Loai</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                @foreach($theloai as $tl)
                                <option 
                                  @if($tintuc->loaitin->theloai->id==$tl ->id)
                                  {{"selected"}}
                                  @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Loai Tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                @foreach($loaitin as $lt)
                                <option 
                                  @if($tintuc->loaitin->id==$lt ->id)
                                  {{"selected"}}
                                  @endif
                                value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Tieu de</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" />
                            </div>

                             <div class="form-group">
                                <label>Tom tat</label>
                                <textarea id="demo" name="TomTat" class="form-control ckeditor" >{{$tintuc->TomTat}}</textarea>
                            </div>

                             <div class="form-group">
                                <label>Noi Dung</label>
                                 <textarea id="demo" name="NoiDung" class="form-control ckeditor" rows="3" >{{$tintuc->NoiDung}}</textarea>
                            </div>

                            <div class="form-group">
                               <label>Hinh anh</label>
                               <p>
                               <img width="350px" src="upload/tintuc/{{$tintuc->Hinh}}">
                             </p>
                               <input type="file" name="Hinh" class="form-control">
                            </div>

                             <div class="form-group">
                                <label>Noi bat</label>
                                <label class="radio-inline">
                                <input class="form-control" name="NoiBat" value="0" 
                                @if($tintuc->NoiBat == 0)
                                {{"checked!"}}
                                @endif
                               type="radio" />No
                              </label>

                              <label class="radio-inline">
                                <input class="form-control" name="NoiBat" value="1" 
                                 @if($tintuc->NoiBat == 1)
                                {{"checked!"}}
                                @endif
                                type="radio" />Yes
                              </label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Update</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  </div>
</div>
    

@endsection

@section('script')
<script>
  
  $(document).ready(function(){
    $("#TheLoai").change(function(){
      var idTheLoai = $(this).val();

      $.get("admin/ajax/LoaiTin/"+idTheLoai,function(data){
        $("#LoaiTin").html(data);
      });
    });
  });
</script>

@endsection