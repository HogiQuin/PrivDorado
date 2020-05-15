@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Crea una cuenta!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-12 mb-3 mb-sm-0">
                                    <input 
                                        id="name" 
                                        type="text" 
                                        class="form-control form-control-user @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name') }}" 
                                        required 
                                        autocomplete="name" 
                                        placeholder="Nombre Completo" 
                                        autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <input 
                                    id="email" 
                                    type="email" 
                                    class="form-control form-control-user @error('email') is-invalid @enderror" 
                                    name="email" value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email" 
                                    placeholder="Correo electronico">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input 
                                        id="password" 
                                        type="password" 
                                        class="form-control form-control-user @error('password') is-invalid @enderror" 
                                        name="password" 
                                        required 
                                        autocomplete="new-password" 
                                        placeholder="Contrasena">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <input 
                                        type="password" 
                                        class="form-control form-control-user" 
                                        id="exampleRepeatPassword" 
                                        placeholder="Repite la contrasena" 
                                        name="password_confirmation">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Crear cuenta
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ url('/login') }}">Ya tienes una cuenta? Entra!</a>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection