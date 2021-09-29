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
                <th><b>Name</b></th>
                <th><b>Username</b></th>
                <th><b>Email</b></th>
                <th><b>Avatar</b></th>
                <th><b>Status</b></th>
                <th><b>Action</b></th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataUsers as $u)
            <tr>
                <td>{{$u->name}}</td>
                <td>{{$u->username}}</td>
                <td>{{$u->email}}</td>
                <td>
                    @if($u->avatar)
                        <img src="{{asset('storage/'.$u->avatar)}}" width="70px"/> 
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @php
                        $statusUser = $u->status;
                    @endphp
                    @if($statusUser == 'ACTIVE')
                        <span class="badge badge-success py-2 px-2">{{ $statusUser }}</span>
                    @else
                        <span class="badge badge-danger py-2 px-2">{{ $statusUser }}</span>
                    @endif
                </td>
                <td>
                    <div class="form-inline">
                        <a href="{{ route('users.show', [$u->id]) }}" class="text-warning px-1"><i class="fa fa-info-circle"></i></a>
                        <a href="{{ route('users.edit', [$u->id]) }}" class="text-primary px-1"><i class="fa fa-edit"></i></a>
                        <form action="{{ route('users.destroy', [$u->id]) }}" method="POST">
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
                    {{$dataUsers->appends(Request::all())->links()}}
                </td>
            </tr>
        </tfoot>
@endsection