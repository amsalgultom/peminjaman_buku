@extends('layouts.app')
@section('title', 'Peminjaman Buku - Anggota')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Anggota</h2>
            </div>
            <div class="pull-right my-3 mb-2">
                <a class="btn btn-primary" href="{{ route('books.index') }}"> Back</a>
            </div>
        </div>
    </div>

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

    <form action="{{ route('members.update',$user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}" placeholder="Username ...">
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="col-sm-6">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}" placeholder="Email ...">
                @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control  form-control-user @error('password') is-invalid @enderror" id="exampleInputPassword" name="password" placeholder="Password ...">
                @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <div class="col-sm-6">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmation Password ...">
            </div>
        </div>
        
        <div class="col-xs-12 col-sm-12 col-md-12 text-center my-5">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

    </form>
</div>
@endsection