@extends('admin.layout.master')
@section('route')
    دسته بندی ها
@endsection
@section('main-content')
    <div class="main-content padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-8 margin-left-10 margin-bottom-15 border-radius-3">
                <p class="box__title"> فرزند دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                            <tr role="row" class="title-row">
                                <th>شناسه</th>
                                <th>نام دسته بندی</th>
                                <th>دسته پدر</th>
                                <th>وضعیت </th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($Categorys != null)
                                @foreach ($Categorys as $cat)
                                    <tr role="row" class="">
                                        <td><a href="">{{ $cat->id }}</a></td>
                                        <td><a href="">{{ $cat->name }}</a></td>
                                        <td>{{ $cat->categoryMenu->name }}</td>
                                        <td><a href="">@if ($cat->active == 1)
                                            فعال
                                        @else
                                            غیر فعال
                                        @endif</a></td>
                                        <td>
                                            <a href="{{ route('AdminPanel.Categorys_remove', ['id'=>$cat->id]) }}" class="item-delete mlg-15" title="حذف"></a>
                                            <a href="{{ route('AdminPanel.Categorys_status', ['id'=>$cat->id]) }}" class="item-eye mlg-15" title="فعال / غیر فعال"></a>
                                            <a href="edit-category.html" class="item-edit " title="ویرایش"></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                دسته ای وجود تدارد
                            @endif


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4 bg-white">
                <p class="box__title">ایجاد دسته بندی جدید</p>
                <form action="{{ route('AdminPanel.Categorys_adds') }}" method="post" class="padding-30">
                    @csrf
                    <input type="text" placeholder="نام دسته بندی" class="text" name="category">

                    <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                    <select name="valedid" id="">
                        @if ($Categoryfamily != null)
                            @foreach ($Categoryfamily as $valed)
                                <option  value="{{ $valed->id }}">{{ $valed->name }}</option>
                            @endforeach
                        @else
                            دسته ای وجود ندارد
                        @endif

                    </select>
                    <button class="btn btn-netcopy_net">اضافه کردن</button>
                </form>

                <p class="box__title">ایجاد دسته بندی والد</p>
                <form action="{{ route('AdminPanel.Categorys_adds') }}" method="post" class="padding-30">
                    @csrf
                    <input type="text" placeholder="نام دسته " class="text" name="valedname">
                    <button class="btn btn-netcopy_net">اضافه کردن</button>
                </form>
            </div>


        </div>



    </div>
@endsection
