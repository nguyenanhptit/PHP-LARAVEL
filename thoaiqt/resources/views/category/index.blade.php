
@extends('layouts.master')

@section('content')

		<h3> All Categories</h3>

    <div class="container-box">
      <form action="{{route('category.search')}}" method="get">
        <div class="input-group">
      <input type="text" name="search" class="form-control" id="title" placeholder="inputname">
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
          <th>Name</th>
          <th>Description</th>
          <th>Modify</th>
        </tr>

      </thead>
       
        <tbody>
          @foreach($categories as $cat)
        </tr>
          <th>{{$cat->title}}</th>
          <th>{{$cat->description}}</th>
          <th><button type="button" class="btn btn-primary" data-mytitle="{{$cat->title}}" data-mydescription="{{$cat->description}}" data-catid={{$cat->id}}
            data-toggle="modal" data-target="#edit">Edit</button>
          
          <button class="btn btn-danger"  data-toggle="modal" data-target="#delete"  data-catid={{$cat->id}}>Delete</button>
        </th>
        </tr>
        @endforeach

        </tbody>
    
    </table>

    <div class="text-center">
      {!!$categories->links();!!}
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
        <h4 class="modal-title" id="myModalLabel">New Categogies</h4>
      </div>.

      <form action="{{route('category.store')}}" method="post" >

      	{{csrf_field()}}
      <div class="modal-body">
      
      @include('category.form')
      	
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
        <h4 class="modal-title" id="myModalLabel">Edit Categogies</h4>
      </div>

      <form action="{{route('category.update','test')}}" method="post" >
        {{method_field('patch')}}
        {{csrf_field()}}
        
      <div class="modal-body">
      <input type="hidden" name="category_id" id="cat_id" >
       @include('category.form')

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
        <h4 class="modal-title" id="myModalLabel">Delete Categogies</h4>
      </div>

      <form action="{{route('category.destroy','test')}}" method="post" >
        {{method_field('delete')}}
        {{csrf_field()}}
        
      <div class="modal-body">

        <p class="text-center">Are you want to delete this!</p>
      <input type="hidden" name="category_id" id="cat_id" >
    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-warning">Yes, Delete</button>
      </div>
  </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
</div> 

@endsection