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
                <div class="card-header">Menampilkan Data tag</div>
                <div class="card-body">
    <div class="form-group">
        <label for="">tag</label>
        <input class="form-control" value="{{ $tag->nama_tag }}" type="text" name="nama_tag" disabled>
    </div>
    <div class="form-group">
        <a href="{{ url('tag') }}" class="btn btn-outline-info">Kembali</a>
    </div>
        </div>
            </div>
                </div>
                    </div>
                        </div>
                            @endsection
