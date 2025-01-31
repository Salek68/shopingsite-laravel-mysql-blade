@extends('layout.master')


@section('container')

<!-- resources/views/cart/index.blade.php -->
<div class="container mt-5">
    <h2>سبد خرید</h2>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
    @if(session()->has('cart'))
        <form action="{{ route('cart.update') }}" method="POST">
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
    @else
        <p>سبد خرید شما خالی است.</p>
    @endif
</div>

@endsection
