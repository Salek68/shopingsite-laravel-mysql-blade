@extends('layout.master')


@section('container')
<style>
    /* body {
      font-family: 'Tahoma', sans-serif;
      background-color: #f8f9fa;
      text-align: center;
      padding: 20px;
    } */
     /* .l1{
        float: right;
     }
     .l2{
        float: left;
     } */
    .container11 {
      max-width: 1000px;
      margin: auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2{
        text-align: center;
    }
    input, select, button , textarea {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
      button {
      background-color: #28a745;
      color: white;
      font-size: 16px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
<!-- resources/views/cart/index.blade.php -->
<div class="container11 mt-5 ">
    <h2>سبد خرید</h2>
    @isset($oid)
    سفارش با موفقیت ثبت شد!
    کد سفارش {{$oid}}
    @endisset




    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    @if(session()->has('cart'))
        <form action="{{ route('cart.update') }}" method="POST" class="l1">
            @csrf
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>محصول</th>
                        <th>قیمت</th>
                        <th>تعداد</th>
                        <th>جمع کل</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(session('cart') as $id => $details)
                        <tr>
                            <td>{{ $details['name'] }}</td>
                            <td> {{number_format((float) ($details['price']), 0, '', ',');}}  ریال</td>
                            <td>
                                <input type="number" name="quantity[{{ $id }}]" value="{{ $details['quantity'] }}" min="1"  class="form-control">
                            </td>
                            <td> {{number_format((float) ($details['price'] * $details['quantity']), 0, '', ',');}}  ریال</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">حذف</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- دکمه بروزرسانی تعداد -->
            <button type="submit" class="btn btn-primary">بروزرسانی سبد خرید</button>
        </form>


        <div class="container l2">

            <h2>تسویه نهایی</h2>

                @foreach ($errors->all() as $e)
                    <li>{{$e}}</li>
                @endforeach


            <form action="{{ route('cart.submit') }}" method="POST" class="l1">
            @php
                $total = 0;
            @endphp
            @foreach(session('cart') as $id => $details)
          @php
              $total += $details['price'] * $details['quantity'];
          @endphp
            @endforeach
            @csrf

            <label>مجموع کل :{{number_format((float) (  $total), 0, '', ',');}}  ریال </label>
            <input type="text" name="total" id="total" placeholder="مثال: علی رضایی" hidden value="{{ $total}}  ">
            <br>
            <label>نام و نام خانوادگی:</label>
            <input type="text" id="name" name="name" placeholder="مثال: علی رضایی" >

            <label>شماره تماس:</label>
            <input type="tel" id="phone"  name="phone" placeholder="مثال: 09121234567">

            <label>آدرس دقیق:</label>
            <textarea type="text" id="address"   name="address" placeholder="مثال: تهران، خیابان ولیعصر، پلاک 10"></textarea>

            <label>نوع ارسال:</label>
            <select id="delivery" name="delivery">
              <option value="post" >پست پیشتاز (۲-۴ روزه)</option>
              <option value="express">پیک موتوری (۱ روزه)</option>
            </select>

            <label>نوع پرداخت:</label>
            <select id="payment" name="payment">
              <option value="online">پرداخت آنلاین</option>
              <option value="cash">پرداخت در محل</option>
            </select>

            <button type="submit" name="submit">پرداخت و ثبت سفارش</button>
            </form>
          </div>
    @else
        <p>سبد خرید شما خالی است.</p>
    @endif



</div>

@endsection
