@extends('admin.layout.master')
@section('route')
    محصولات
@endsection
@section('main-content')
<div class="main-content">
    <div class="tab__box">
        <div class="tab__items">
            <a class="tab__item
                @if ($stoke == 0 && $notstoke == 0)
is-active
                @endif
               " href="{{ route('AdminPanel.Products') }}">لیست محصول ها</a>
            <a class="tab__item  @isset($stoke)
                @if ($stoke == '1')
is-active
                @endif
                @endisset" href="{{ route('AdminPanel.Products_stoke') }}">محصول های  موجود</a>
            <a class="tab__item
            @isset($notstoke)
                @if ($notstoke == '1')
is-active
                @endif
                @endisset" href="{{ route('AdminPanel.Products_notstoke') }}">محصول های  تمام شده</a>
            <a class="tab__item" href="create-new-course.html">ایجاد محصول جدید</a>
        </div>
    </div>
    <div class="bg-white padding-20">
        <div class="t-header-search">
            <form action="{{ route('AdminPanel.Products_serech') }}" method="POST" >
                <div class="t-header-searchbox font-size-13">
                    <div type="text" class="text search-input__box ">جستجوی محصول</div>
                    <div class="t-header-search-content ">
                        @csrf
                        <input type="text"  class="text"  placeholder="نام محصول" name="name">
                        <input type="text"  class="text" placeholder="قیمت" name="price">
                        <input type="text"  class="text margin-bottom-20" placeholder="دسته بندی" name="cat">
                        <button type="submit" class="btn btn-netcopy_net">جستجو</button>
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
                <th>کد کالا</th>
                <th>دسته کالا</th>
                <th>نام محصول</th>
                <th>قیمت (ریال)</th>
                <th>موجودی</th>
                <th> تعداد فروش</th>
                <th>تعداد بازدید</th>
                <th>ویژه</th>
                <th>وضعیت </th>
                <th>عملیات</th>
            </tr>
            </thead>
            <tbody>
                @if ($Products != null)
                @foreach ($Products as $item)
                <tr role="row" >
                    <td><a href="">{{$item->sku}}</a></td>
                    <td><a href="">{{$item->id}}</a></td>
                    <td><a href="">{{$item->name}}</a></td>
                    <td><a href="">{{$item->product_name}}</a></td>
                    <td><a href="">{{number_format((float) ($item->price -  (($item->price  *  $item->discount) / 100)   ), 0, '', ',');}}</a></td>
                    <td><a href="">{{$item->stock}}</a></td>
                    <td><a href="">{{$item->sold}}</a></td>
                    <td><a href="">{{$item->view}}</a></td>
                    <td><a href="">@if ($item->is_featured == 1)
                       ویژه است
                    @else
                        ویژه نیست
                    @endif</a></td>
                    <td><a href="">@if ($item->status == "active")
                         فعال
                     @else
                         غیر فعال
                     @endif</a></td>
                    <td>

                        <a href="{{ route('AdminPanel.Products_remove', ['id'=>$item->product_id]) }}" class="item-delete mlg-15" title="حذف"></a>
                        <a href="{{ route('AdminPanel.Products_status', ['id'=>$item->product_id]) }}" class="item-lock mlg-15" title="قفل "></a>
                        <a href="{{ route('AdminPanel.Products_fe', ['id'=>$item->product_id]) }}"  class="item-eye mlg-15" title="ویژه کردن از ویژه در اوردن"></a>
                        <a href="{{ route('AdminPanel.Products_status', ['id'=>$item->product_id]) }}" class="item-confirm mlg-15" title="باز"></a>
                        <a href="" class="item-edit " title="ویرایش"></a>

                    </td>
                </tr>
                @endforeach
                @else
                محصولی برای نمایش نیست
            @endif


            </tbody>
        </table>
    </div>
</div>

@endsection
