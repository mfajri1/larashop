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
    @elseif(session('status') == 'password no match')
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            Password Invalid...!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <form action="{{route('users.store')}}" class="bg-white shadow-sm p-3" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Masukkan name..." required autofocus>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control form-control-sm" placeholder="Masukkan Username..." required>
        </div>
        <div class="form-group">
            <label for="roles">Role</label>
            <select multiple class="form-control form-control-sm" name="roles[]" id="roles">
              <option value="ADMIN">Admin</option>
              <option value="STAFF">Staff</option>
              <option value="Costumer">Costumer</option>
            </select>
        </div>
        <div class="form-group">
            <label for="phone">Nomor Telephone</label>
            <input type="text" name="phone" id="phone" class="form-control form-control-sm" placeholder="Masukkan Nomor Telephone..." required>
        </div>
        <div class="form-group">
            <label for="phone">Alamat</label>
            <textarea name="address" class="form-control form-control-sm" id="address" cols="30" rows="4"></textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Gambar Avatar</label>
            <input type="file" name="avatar" id="avatar" class="form-control form-control-sm" placeholder="Masukkan Avatar..." required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control form-control-sm" placeholder="Masukkan Email..." required>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Masukkan Password..." required>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label for="repassword">Re-Password</label>
                    <input type="password" name="repassword" id="repassword" class="form-control form-control-sm" placeholder="Masukkan Re-Password..." required>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control form-control-sm" name="status" id="status">
                <option value="">Pilih Status</option>
                <option value="ACTIVE">ACTIVE</option>
                <option value="INACTIVE">INACTIVE</option>
            </select>
        </div>
        <button type="submit" name="simpan" value="simpan" class="btn btn-outline-primary ">Simpan</button>

        
    </form>
@endsection