@extends('auth.layouts')

@section('content')

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 align-self-center text-center">
                        <img src="https://media.licdn.com/dms/image/C560BAQGu0gVz6iYUiA/company-logo_200_200/0/1551780588363?e=2147483647&v=beta&t=kthX8R37vNbOwB9SCb2n7IvFkTTbg-kjvN6FfskVKbY" width="80%" alt="">
                    </div>
                    @guest
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Login!</h1>
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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Remember
                                            Me</label>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                <hr>
                            </form>
                        </div>
                    </div>
                    @else
                    @if(Auth::user()->type == 'admin')
                    <div class="col-lg-6 align-self-center text-center">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Halo, {{Auth::user()->name}} </h1>
                                <a href="/admin/dashboard" class="btn btn-primary btn-icon-split btn-lg">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Pergi ke dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-6 align-self-center text-center">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Halo, {{Auth::user()->name}} </h1>
                                <a href="/member/dashboard" class="btn btn-primary btn-icon-split btn-lg">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-flag"></i>
                                    </span>
                                    <span class="text">Pergi ke dashboard</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endguest
                </div>
            </div>
        </div>

    </div>

</div>

@endsection