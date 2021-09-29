@extends('layouts.global')
@section('title')
    Data Kategori
@endsection
@section('pageTitle')
    Data List Kategori
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ route('category.create') }}" class="btn btn-outline-primary mb-2"><i class="fa fa-plus"></i> Tambah</a>
            <a href="{{ route('category.create') }}" class="btn btn-outline-success mb-2"><i class="fa fa-trash"></i> Trash</a>
        </div>
        <div class="col-sm-8">
            <div class="row mb-2">
                <div class="col-md-12">
                    <form action="{{route('category.index')}}">
                        <div class="row">
                            <div class="col-sm-4 offset-sm-2">
                                <input value="{{Request::get('keywordEmail')}}" name="keywordEmail" class="form-control" type="text" placeholder="Filter berdasarkan email"/>
                            </div>
                            <div class="col-sm-4">
                                <select class="custom-select" name="keyStatus">
                                    <option {{Request::get('keyStatus')}} value="">Pilih Menu</option>
                                    <option value="ACTIVE" {{Request::get('keyStatus') == 'ACTIVE' ? 'selected' : ''}}>ACTIVE</option>
                                    <option value="INACTIVE" {{Request::get('keyStatus') == 'INACTIVE' ? 'selected' : ''}}>INACTIVE</option>
                                </select>    
                            </div>
                            <div class="col-sm-2 align-self-end">
                                <input type="submit" value="Filter" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th><b>Name</b></th>
                <th><b>Slug</b></th>
                <th><b>Image</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($category as $c)
            <tr>
                <td>{{$c->name}}</td>
                <td>{{$c->slug}}</td>
                <td>
                    @if($c->image)
                        <img src="{{asset('storage/'.$c->image)}}" width="70px"/> 
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    <div class="form-inline">
                        <a href="{{ route('category.show', [$c->id]) }}" class="text-warning px-1"><i class="fa fa-info-circle"></i></a>
                        <a href="{{ route('category.edit', [$c->id]) }}" class="text-primary px-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('category.destroy', [$c->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" value="delete" class="text-danger btn btn-link px-1"><i class="fa fa-trash"></i></button>
                        </form>
                        
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan=10>
                    {{$category->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
@endsection