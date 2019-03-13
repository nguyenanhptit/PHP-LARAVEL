 @extends('layouts.adminLayout.admin_design')

@section('content')

 <!-- Page Content -->
 <div id="content">
  <div class="container-fluid">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tuc
                            <small>List</small>
                        </h1>
                    </div>

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
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tieu De</th>
                                <th>Tom Tat</th>
                                <th>The Loai</th>
                                <th>Loai Tin</th>
                                <th>Xem</th>
                                <th>Noi Bat</th>

                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$tt->id}}</td>
                                <td><p>{{$tt->TieuDe}}</p>
                                    <img src="upload/tintuc/{{$tt->Hinh}}" width="100px">
                                </td>
                                <td>{{$tt->TomTat}}</td>
                               
                                <td>{{$tt->loaitin->theloai->Ten}}</td>
                                <td>{{$tt->loaitin->Ten}}</td>

                                <td>{{$tt->SoLuotXem}}</td>
                                <td>
                                @if($tt->NoiBat == 0)
                                {{'No'}}
                                @else
                                {{'Yes'}}
                                @endif
                            </td>
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/TinTuc/xoa/{{$tt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/TinTuc/sua/{{$tt->id}}">Edit</a></td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
</div>
</div>        
        @endsection