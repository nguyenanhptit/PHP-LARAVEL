@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Welcome </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>

                    @endif

                    You are logged in roaming management system Viettel!
                </div>
            </div>
        </div>
    </div>
</div>

 <div class="container-box">
      <form action="{{route('category.search')}}" method="get">
        <div class="input-group">
      <input type="text" name="search" class="form-control" id="title">

       
      <span class="input-group-prepend">
        <button type="submit"  class="btn btn-primary">Search</button>
      </span>
         </div>   
        </form>
    </div>
@endsection
