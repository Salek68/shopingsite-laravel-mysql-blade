
@extends('layout.masterpanel')

@section('main-content')

<div class="main-content">
    <div class="user-info bg-white padding-30 font-size-13">
        <form action="@yield('routea')" method="POST">
            <div class="profile__info border cursor-pointer text-center">
                <div class="avatar__img"><img src="{{ asset('admin/img/pro.jpg') }}" class="avatar___img">
                    <input type="file" accept="image/*" class="hidden avatar-img__input">
                    <div class="v-dialog__container" style="display: block;"></div>
                    <div class="box__camera default__avatar"></div>
                </div>
                <span class="profile__name">کاربر :  @yield('nameuser')</span>
            </div>
            @yield('inputs')

            <button type="submit" class="btn btn-netcopy_net" name="@yield('type')" value="@yield('type')">@yield('savename') </button>
        </form>
    </div>

</div>

@endsection
