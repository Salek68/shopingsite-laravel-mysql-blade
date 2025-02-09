@extends('layout.master')

@section('container')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-center bg-dark text-white">
                <h3>ورود</h3>
                @isset($mess)
                <h4>{{$mess}}</h4>

                @endisset
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('Login.check') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">ایمیل</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">کلمه عبور</label>
                        <input type="password" class="form-control @error('status') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">مرا به خاطر بسپار</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-dark btn-lg">ورود</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>حساب کاربری ندارید؟ <a href="{{route('Register.index')}}">ثبت نام</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
