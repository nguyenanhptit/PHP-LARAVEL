@extends('layouts.adminLayout.admin_design')

@section('content')
  {{-- <div id="content">
  <div class="container-fluid">
		<h3> All Categories</h3> --}}

    {{-- <div class="container-box">
      <form action="{{route('category.search')}}" method="get">
        <div class="input-group">
      <input type="text" name="search" class="form-control" id="Ten" placeholder="inputname">
      <span class="input-group-prepend">
        <button type="submit"  class="btn btn-primary">Search</button>
      </span>
         </div>   
        </form>
    </div>
    
    <div>
    <a href="{{route('category.export')}}" onclick="" class="btn btn-success" style="margin-top: -8px;" > Export Excel</a>
  </div>
 
    <table class="table data-reponsive">
      <thead>
        <tr>
          <th>Ten</th>
          <th>TenKhongDau</th>
          <th>Modify</th>
        </tr>

      </thead>
       
        <tbody>
          @foreach($theloais as $the)
        </tr>
          <th>{{$the->Ten}}</th>
          <th>{{$the->TenKhongDau}}</th>
          <th><button type="button" class="btn btn-primary" data-myTen="{{$the->Ten}}" data-myTenKhongDau="{{$the->TenKhongDau}}" data-theloaiid={{$the->id}}
            data-toggle="modal" data-target="#edit">Edit</button>
          
          <button class="btn btn-danger"  data-toggle="modal" data-target="#delete"  data-theloaiid={{$the->id}}>Delete</button>
        </th>
        </tr>
        @endforeach

        </tbody>
    
    </table>

    <div class="text-center">
      {!!$theloais->links();!!}
    </div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Add New
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">New </h4>
      </div>.

      <form action="{{route('TheLoai.store')}}" method="post" >

      	{{csrf_field()}}
      <div class="modal-body">
      
      @include('admin.TheLoai.form')
      	
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
  </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit </h4>
      </div>

      <form action="{{route('TheLoai.update','test')}}" method="post" >
        {{method_field('patch')}}
        {{csrf_field()}}
        
      <div class="modal-body">
      <input type="hidden" name="theloai_id" id="the_id" >
       @include('admin.TheLoai.form')

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Changes</button>
      </div>
  </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal modal-danger fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Delete </h4>
      </div>

      <form action="{{route('TheLoai.destroy','test')}}" method="post" >
        {{method_field('delete')}}
        {{csrf_field()}}
        
      <div class="modal-body">

        <p class="text-center">Are you want to delete this!</p>
      <input type="hidden" name="theloai_id" id="the_id" >
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-warning">Yes, Delete</button>
      </div>
  </form>
    </div>
  </div>
</div>
</div>

</div>

<!-- Modal -->
{{-- <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">search Categogies</h4>
      </div>

      <form action="{{route('category.search')}}" method="get" >
        {{method_field('')}}
        {{csrf_field()}}
        
      <div class="modal-body">
      <input type="hidden" name="category_id" id="cat_id" >
       
  </form>
    </div>
  </div>
</div>  --}}



<!-- Page Content -->

<div id="content">
  <div class="container-fluid">
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">The Loai
                            <small>Add</small>
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


                        <form action="admin/TheLoai/them" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>The Loai</label>
                                <input class="form-control" name="Ten" placeholder="input the loai" />
                            </div>
                            
                            <button type="submit" class="btn btn-default"> Add</button>
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