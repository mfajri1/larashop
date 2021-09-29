@extends('layouts.global')
@section('title')
    Create User
@endsection
@section('pageTitle')
    Tambah User
@endsection
@section('content')
    @if(session('status') == "sukses")
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Sukses Menambahkan Data...!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
        </div>
    @elseif(session('status') == "gambar invalid")
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            File Gambar Invalid...!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{route('category.store')}}" class="bg-white shadow-sm p-3" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Masukkan name..." value="{{ $category->name }}" required autofocus>
        </div>
        <div class="form-group">
            <label for="image">Gambar</label>
            <input type="file" name="image" id="image" class="form-control form-control-sm" placeholder="Masukkan Gambar..." required>
        </div>
        <button type="submit" name="simpan" value="simpan" class="btn btn-outline-primary ">Simpan</button>

        
    </form>
@endsection