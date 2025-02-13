<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
<title> پنل مدیریت | ادمین</title>    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href={{ asset('admin/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('admin/css/font.css') }}">
</head>
<body>
<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href="https://netcopy.ir"></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{ asset('admin/img/pro.jpg') }}" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name"> @php
            if(session('user_name')){
                $userName = Crypt::decrypt(session('user_name'));
                $uid =Crypt::decrypt(session('user_id'));
            }

        @endphp
        @isset($userName)
{{$userName}}
        @endisset

    </span>
    </div>

    <ul>
        {{-- @if (session('user_ac'))
        @foreach (session('user_ac') as $item )
        @if ($item->pos != "all")
        <li class="item-li {{ $item->i }} @isset($is_active)  @if ($is_active == $item->id) is-active @endif @endisset">
            <a href="{{ route($item->route) }}">{{ $item->pos }}</a>
        </li>
        @else
        @php
            $all = true;
        @endphp
        @endif




        @endforeach
    @else

    @endif --}}

    <li class="item-li i-dashboard  @isset($is_active)  @if ($is_active == 1) is-active @endif @endisset"><a href="{{ route('UserPanel.index') }}">پیشخوان </a></li>
        <li class="item-li i-user__inforamtion  @isset($is_active)  @if ($is_active == 2) is-active @endif @endisset"><a href="{{ route('UserPanel.UserInfo' , [ 'id' => $uid]) }}">اطلاعات کاربری</a></li>


    </ul>

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="" href=""> @php
                if(session('user_name')){
                    $userName = Crypt::decrypt(session('user_name'));
                }

            @endphp
            @isset($userName)
    {{$userName}}
            @endisset</a>
        </div>
        <div class="header__left d-flex flex-end item-center margin-top-2">
            <span class="account-balance font-size-12">موجودی : 2500,000 تومان</span>
            <div class="notification margin-15">
                <a class="notification__icon"></a>
                <div class="dropdown__notification">
                    <div class="content__notification">
                        <span class="font-size-13">موردی برای نمایش وجود ندارد</span>
                    </div>
                </div>
            </div>
            <a href="{{ route('AdminPanel.Users_logaout') }}" class="logout" title="خروج"></a>
        </div>
    </div>
    <div class="breadcrumb">
        <ul>
            <li><a href="index.html" title="@yield('route')">@yield('route')</a></li>
          </ul>
    </div>

@yield('main-content')

</div>
</body>
<script src="{{ asset('admin/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('admin/js/js.js') }}"></script>
</html>
