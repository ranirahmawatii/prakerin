@extends('layouts.back')
@section('css')
<link rel="stylesheet" href="/backend/assets/vendor/select2/select2.min.css">
@endsection

@section('js')
    <script src="/backend/assest/vendor/select2/select2.min.js"></script>
    <script src="/backend/assest/js/components/select2-init.js"></script>
    <script src="/backend/assets/vendor/ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editorl');
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Membuat Data Kategori</div>
                <div class="card-body">
                    <form action="{{ route('kategori.store') }}" method="post">
                        {{ csrf_field() }}

    <div class="form-group">
        <label for="">Kategori</label>
        <input class="form-control" type="text" name="nama_kategori">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-info">
        Simpan Data
        </button>
    </div>
    <div class="form-group">
        <a href="{{ url('kategori') }}" class="btn btn-outline-info">Kembali</a>
    </div>
        </form>
            </div>
                </div>
                    </div>
                        </div>
                            </div>
                                @endsection