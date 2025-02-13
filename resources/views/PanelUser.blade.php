@extends('layout.masterpanel')
@section('route')
داشبورد
@endsection
@section('main-content')
<div class="main-content">
    @php
    $status0 =0;
    $status1 =0;
    $status2 =0;
    $status3 =0;
    $status11 =0;

@endphp
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-2 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            @foreach ($orders as $order)
            @if ($order->status == 0)
          @php
              $status0 +=1;
          @endphp
                        @elseif ($order->status == 1)
                        @php
                        $status1 +=1;
                    @endphp
                        @elseif ($order->status == 2)
                        @php
              $status2 +=1;
          @endphp
                        @elseif ($order->status == 3)
                        @php
                        $status3 +=1;
                    @endphp
                        @else
                        @php
                        $status11 +=1;
                    @endphp
                        @endif

            @endforeach
            <p>   سفارشات تکمیل شده </p>
            <p style="   margin-top: 10px;     text-align: center;
    border-radius: 100%;
    background: red;
    width: 25px;
    color: white;
    margin-right: 100px;">@isset($status3)
                        {{ $status3}}
            @endisset</p>
        </div>
        <div class="col-2 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>   سفارشات  در انتظار پرداخت </p>
            <p style="  margin-top: 10px;      text-align: center;
            border-radius: 100%;
            background: red;
            width: 25px;
            color: white;
            margin-right: 100px;">@isset($status0)
                        {{ $status0}}
            @endisset</p>
        </div>
        <div class="col-2 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>   سفارشات در حال انجام </p>
            <p style=" margin-top: 10px;       text-align: center;
            border-radius: 100%;
            background: red;
            width: 25px;
            color: white;
            margin-right: 100px;">@isset($status2)
                        {{ $status2}}
            @endisset</p>
        </div>
        <div class="col-2 padding-20 border-radius-3 bg-white  margin-left-10 margin-bottom-10">
            <p>   سفارشات در انتظار برسی </p>
            <p style=" margin-top: 10px;       text-align: center;
            border-radius: 100%;
            background: red;
            width: 25px;
            color: white;
            margin-right: 100px;">@isset($status1)
                        {{ $status1}}
            @endisset</p>
        </div>
        <div class="col-2 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p>   سفارشات لغو شده </p>
            <p style=" margin-top: 10px;    text-align: center;
            border-radius: 100%;
            background: red;
            width: 25px;
            color: white;
            margin-right: 100px;">@isset($status11)
                        {{ $status11}}
            @endisset</p>
        </div>
    </div>
    {{-- <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد امروز </p>
            <p>500,000 تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> درآمد 30 روز گذاشته</p>
            <p>2,500,000 تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> تسویه حساب در حال انجام </p>
            <p>0 تومان </p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white  margin-bottom-10">
            <p>تراکنش های موفق امروز (0) تراکنش </p>
            <p>2,500,000 تومان</p>
        </div>
    </div> --}}
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
            محل قرار گیری نمودار
        </div>
        <div class="col-4 info-amount padding-20 bg-white margin-bottom-12-p margin-bottom-10 border-radius-3">

            <p class="title icon-outline-receipt">موجودی قابل تسویه </p>
            <p class="amount-show color-444">600,000<span> تومان </span></p>
            <p class="title icon-sync">در حال تسویه</p>
            <p class="amount-show color-444">0<span> تومان </span></p>
            <a href="/" class=" all-reconcile-text color-2b4a83">همه تسویه حساب ها</a>
        </div>
    </div>
    <div class="row bg-white no-gutters font-size-13">
        <div class="title__row">
            <p>سفارش  های اخیر </p>
            <a class="all-reconcile-text margin-left-20 color-2b4a83">نمایش همه سفارش ها</a>
        </div>
        <div class="table__box">
            <table width="100%" class="table">
                <thead role="rowgroup">
                <tr role="row" class="title-row">
                    <th>شناسه سفارش</th>
                    <th>نام سفارش دهنده</th>
                    <th>مبلغ (ریال)</th>
                    <th> نوع ارسال</th>
                    <th> نوع پرداخت</th>
                    <th>شماره همراه سفارش دهنده</th>
                    <th>تاریخ و ساعت</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
          @foreach ($orders as $order)
          <tr role="row">
            <td><a href=""> {{$order->id}}</a></td>
            <td><a href="">{{$order->name}}</a></td>
            <td><a href="">{{number_format((float) ( $order->total_price    ), 0, '', ',');}}</a></td>
            <td><a href="">{{$order->delivery}}</a></td>
            <td><a href="">{{$order->payment}}</a></td>
            <td><a href="">{{$order->phone}}</a></td>
            <td><a href=""> {{$order->updated_at}}</a></td>
            <td><a href="" class="text-error"> @if ($order->status == 0)
منتظر پرداخت
            @elseif ($order->status == 1)
            سفارش شما درحال برسی است
            @elseif ($order->status == 2)
            سفارش شما تایید و در حال انجام است
            @elseif ($order->status == 3)
            سفارش شما تکمیل و تحویل پست داده شد
            @else
لغو شده
            @endif</a></td>
            <td class="i__oprations">

                <a href="{{ route('UserPanel.Orders_remove', ['id'=>$order->id]) }}" class="item-delete margin-left-10" title="لغو"></a>

            </td>
        </tr>
          @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
