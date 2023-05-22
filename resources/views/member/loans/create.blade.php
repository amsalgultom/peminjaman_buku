@extends('layouts.app')
@section('title', 'Peminjaman Buku - Buku')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Buat Data Peminjaman Buku</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('loans.index') }}"> <i class="fa fa-arrow-left"></i> Kembali</a>
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

    <form action="{{ route('loans.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Buku:</strong>
                    <select required class="form-control" name="book_id">
                        <option hidden selected value="">- Pilih Buku -</option>
                        @foreach($books as $book)
                        <option value="{{$book->id}}">{{$book->judul}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Tanggal Peminjaman:</strong>
                    <input type="date" name="loan_date" class="form-control" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6">
                <div class="form-group">
                    <strong>Tanggal Pengembalian:</strong>
                    <input type="date" name="return_date" class="form-control" required>
                </div>
            </div>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="status" value="Request Loan">
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>

    </form>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
@endsection