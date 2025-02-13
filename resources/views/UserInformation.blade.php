<link rel="stylesheet" href="{{ asset('admin/css/responsive_991.css') }}" media="(max-width:991px)">
<link rel="stylesheet" href="{{ asset('admin/css/responsive_768.css') }}" media="(max-width:768px)">

@extends('layout.UserInform')


@section('nameuser')
{{$user->name}}
@isset($mess)
{{$mess}}
@endisset
@endsection

@section('routea')
{{ route('Register.Register') }}
@endsection
@section('route')
اطلاعات کاربری
@endsection
@section('inputs')
@csrf
<input class="text" placeholder="نام " value="{{$user->name}}" name="name">
            <input class="text text-left @error('email') is-invalid @enderror" placeholder="ایمیل" value="{{$user->email}}" name="email">
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            <input class="text text-left @error('dup') is-invalid @enderror" placeholder="رمز عبور" name="pass">
            @error('dup')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
            <p class="rules">رمز عبور باید حداقل ۶ کاراکتر و ترکیبی از حروف بزرگ، حروف کوچک، اعداد و کاراکترهای
                غیر الفبا مانند <strong>!@#$%^&*()</strong> باشد.</p>
            <br>
            <input class="text text-left" placeholder="تایید رمز عبور" name="passver">
            <br>
            <br>
@endsection
@section('savename')
ذخیره تعغیرات
@endsection
@section('type')
chenge
@endsection


