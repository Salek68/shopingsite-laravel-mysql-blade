@extends('layout.master')

@section('container')

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-header text-center bg-dark text-white">
                    <h3>ثبت نام</h3>

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('Register.Register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">نام کامل</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">ایمیل</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">کلمه عبور</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">تأیید کلمه عبور</label>
                            <input type="password" class="form-control  @error('dup') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                            @error('dup')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-dark btn-lg">ثبت نام</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>قبلاً حساب کاربری دارید؟ <a href="{{ route('Login.index') }}">ورود</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
