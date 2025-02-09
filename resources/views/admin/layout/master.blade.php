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
        <span class="profile__name">کاربر : @php
            $userName = Crypt::decrypt(session('user_name'));
        @endphp
{{$userName}}
    </span>
    </div>

    <ul>
        <li class="item-li i-dashboard is-active"><a href="{{ route('AdminPanel.index') }}">پیشخوان</a></li>
        <li class="item-li i-courses "><a href="courses.html">دوره ها</a></li>
        <li class="item-li i-users"><a href="{{ route('AdminPanel.Users') }}"> کاربران</a></li>
        <li class="item-li i-categories"><a href="categories.html">دسته بندی ها</a></li>
        <li class="item-li i-slideshow"><a href="slideshow.html">اسلایدشو</a></li>
        <li class="item-li i-banners"><a href="banners.html">بنر ها</a></li>
        <li class="item-li i-articles"><a href="articles.html">مقالات</a></li>
        <li class="item-li i-ads"><a href="ads.html">تبلیغات</a></li>
        <li class="item-li i-comments"><a href="comments.html"> نظرات</a></li>
        <li class="item-li i-tickets"><a href="tickets.html"> تیکت ها</a></li>
        <li class="item-li i-discounts"><a href="discounts.html">تخفیف ها</a></li>
        <li class="item-li i-transactions"><a href="transactions.html">تراکنش ها</a></li>
        <li class="item-li i-checkouts"><a href="checkouts.html">تسویه حساب ها</a></li>
        <li class="item-li i-checkout__request "><a href="checkout-request.html">درخواست تسویه </a></li>
        <li class="item-li i-my__purchases"><a href="mypurchases.html">خرید های من</a></li>
        <li class="item-li i-my__peyments"><a href="mypeyments.html">پرداخت های من</a></li>
        <li class="item-li i-notification__management"><a href="notification-management.html">مدیریت اطلاع رسانی</a>
        </li>
        <li class="item-li i-user__inforamtion"><a href="user-information.html">اطلاعات کاربری</a></li>
    </ul>

</div>
<div class="content">
    <div class="header d-flex item-center bg-white width-100 border-bottom padding-12-30">
        <div class="header__right d-flex flex-grow-1 item-center">
            <span class="bars"></span>
            <a class="" href=""> @php
                $userName = Crypt::decrypt(session('user_name'));
            @endphp
    {{$userName}}</a>
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
            <a href="" class="logout" title="خروج"></a>
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
