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
                <div class="card-header">Membuat Data Tag</div>
                <div class="card-body">
                    <form action="{{ route('tag.store') }}" method="post">
                        {{ csrf_field() }}

    <div class="form-group">
        <label for="">Tag</label>
        <input class="form-control" type="text" name="nama_tag">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-outline-info">
        Simpan Data
        </button>
    </div>
    <div class="form-group">
        <a href="{{ url('tag') }}" class="btn btn-outline-info">Kembali</a>
    </div>
        </form>
            </div>
                </div>
                    </div>
                        </div>
                            </div>
                                @endsection