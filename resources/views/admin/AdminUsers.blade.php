@extends('admin.layout.master')
@section('route')
    کاربران
@endsection
@section('main-content')
    <div class="main-content font-size-13">
        <div class="tab__box">
            <div class="tab__items">
                <a class="tab__item @isset($all)
                @if ($all == '1')
is-active
                @endif
                @endisset" href="{{ route('AdminPanel.Users') }}">همه کاربران</a>
                <a class="tab__item @isset($admins)
                @if ($admins == '1')
is-active
                @endif
                @endisset" href="{{ route('AdminPanel.Users.admins') }}">مدیران</a>
                <a class="tab__item" href="create-user.html">ایجاد کاربر جدید</a>
            </div>
        </div>
        <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
            <div class="t-header-search"  @isset($admins) @if ($admins == '1') hidden  @endif  @endisset>
                <form action="{{ route('AdminPanel.Users_serech') }}" method="POST">
                    <div class="t-header-searchbox font-size-13">

                        <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی کاربر">
                        <div class="t-header-search-content ">
                            @csrf
                            <input type="text" class="text" placeholder="ایمیل" name="email">
                            <input type="text" class="text margin-bottom-20" placeholder="نام و نام خانوادگی" name="name">
                          <button type="submit">  <btutton  class="btn btn-netcopy_net">جستجو</btutton></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="table__box">
            <table class="table">
                <thead role="rowgroup">
                    <tr role="row" class="title-row">
                        <th>شناسه</th>
                        <th>نام و نام خانوادگی</th>
                        <th>ایمیل</th>
                        <th>سطح کاربری</th>
                        <th>تاریخ عضویت</th>
                        <th>وضعیت حساب</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($user as $td)
                        <tr role="row" class="">
                            <td>{{ $td->id }}</td>
                            <td>{{ $td->name }}</td>
                            <td>{{ $td->email }}</td>
                            <td>
                                @if ($td->isadmin == 1)
                                ادمین
                                @else
                                کاربر عادی
                                @endif
                            </td>
                            <td>{{$td->created_at}}</td>
                            @if ($td->status == 1)
                            <td class="text-success">
                                فعال
                            </td>
                                @else
                                <td class="text-error">
                                    غیر فعال
                                </td>
                                @endif
                            <td>

                                @if (session('ac') == true)
                                <a href="{{ route('AdminPanel.Users_remove', ['id'=>$td->id]) }}" class="item-delete mlg-15" title="حذف"></a>
                                <a href="{{ route('AdminPanel.Users_status', ['id'=>$td->id]) }}" class="item-confirm mlg-15" title="تایید"></a>
                                <a href="{{ route('AdminPanel.Users_status', ['id'=>$td->id]) }}" class="item-reject mlg-15" title="رد"></a>
                                <a href="edit-user.html" class="item-edit " title="ویرایش"></a>
                                @else
                                <a>دسترسی ندارید</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>
        </div>
    </div>
@endsection
