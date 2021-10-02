@extends('layouts.global')
@section('footer-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('#categories').select2({
            ajax: {
                    url: '/ajax/category/search',
                    processResults: function(data){
                        return {
                            results: data.map(function(item){
                                return { 
                                    id: item.id, 
                                    text:item.name 
                                } 
                            })
                        }
                    }
                }
        });
    </script>
@endsection
@section('title')
    Create Book
@endsection
@section('pageTitle')
    Tambah Book
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
    <form action="{{route('book.store')}}" class="bg-white shadow-sm p-3" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Book Title</label>
            <input type="text" name="title" id="title" class="form-control form-control-sm" placeholder="Masukkan Book Title..." required autofocus>
        </div>
        <div class="form-group">
            <label for="cover">Cover</label>
            <input type="file" name="cover" id="cover" class="form-control form-control-sm" required autofocus>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control form-control-sm" id="description" rows="4" cols="10" placeholder="Masukkan Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="categories">Categories</label>
            <select name="categories[]" multiple id="categories" class="form-control"></select>
        </div>
        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="text" name="stock" id="stock" class="form-control form-control-sm" placeholder="Masukkan Stock..." required>
        </div>
        <div class="form-group">
            <label for="author">Book Author</label>
            <input type="text" name="author" id="author" class="form-control form-control-sm" placeholder="Masukkan Book Author..." required>
        </div>
        <div class="form-group">
            <label for="publisher">Publisher</label>
            <input type="text" name="publisher" id="publisher" class="form-control form-control-sm" placeholder="Masukkan Book Publisher..." required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" id="price" class="form-control form-control-sm" placeholder="Masukkan Price..." required>
        </div>
        <button name="save_action" value="PUBLISH" class="btn btn-outline-primary ">Publish</button>
        <button name="save_action" value="DRAFT" class="btn btn-outline-secondary ">Save As Draft</button>
    </form>
@endsection

