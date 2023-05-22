@extends('layouts.app')
@section('title', 'Peminjaman Buku - Buku')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Buat Data B uku</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> <i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
        </div>
    </div>
    <br>
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Error!</strong> <br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Judul:</strong>
                    <input type="text" name="judul" class="form-control" required placeholder="Isi Judul Buku">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Kode:</strong>
                    <input type="text" name="kode" class="form-control" required placeholder="Isi Kode Buku">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Penulis:</strong>
                    <input type="text" name="penulis" class="form-control" required placeholder="Isi Penulis Buku">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Tahun Terbit:</strong>
                    <select required class="form-control" name="tahun_terbit">
                    <option hidden selected value="">- Pilih Tahun Terbit -</option>
                        @foreach(array_reverse($years) as $year)
                        <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Stok:</strong>
                    <input type="number" name="stok" min="0" class="form-control" required placeholder="Isi Stok Buku">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

    </form>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
@endsection