@extends('layouts.global')
@section('title')
    Data User
@endsection
@section('pageTitle')
    Data List User
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-4">
            <a href="{{ route('users.create') }}" class="btn btn-outline-primary mb-2"><i class="fa fa-plus"></i> Tambah</a>
        </div>
        <div class="col-sm-8">
            <div class="row mb-2">
                <div class="col-md-12">
                    <form action="{{route('users.index')}}">
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
                <th><b>Cover</b></th>
                <th><b>Title</b></th>
                <th><b>Author</b></th>
                <th><b>Status</b></th>
                <th><b>Category</b></th>
                <th><b>Stock</b></th>
                <th><b>Price</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($book as $b)
            <tr>
                <td>
                    @if($b->cover)
                        <img src="{{asset('storage/'.$b->cover)}}" width="70px"/> 
                    @else
                        N/A
                    @endif
                </td>
                <td>{{$b->title}}</td>
                <td>{{$b->author}}</td>
                <td>
                    @php
                        $statusBook = $b->status;
                    @endphp
                    @if($statusBook == 'PUBLISH')
                        <span class="badge badge-primary py-2 px-2">{{ $statusBook }}</span>
                    @else
                        <span class="badge badge-success py-2 px-2">{{ $statusBook }}</span>
                    @endif
                </td>
                <td>
                    <ul class="pl-3">
                        @foreach ($b->modelCategory as $mc)
                            <li>{{ $mc->name }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{$b->stock}}</td>
                <td>{{$b->price}}</td>
                <td>
                    <div class="form-inline">
                        <a href="{{ route('users.show', [$b->id]) }}" class="text-warning px-1"><i class="fa fa-info-circle"></i></a>
                        <a href="{{ route('users.edit', [$b->id]) }}" class="text-primary px-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('users.destroy', [$b->id]) }}" method="POST">
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
                    {{$book->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
@endsection