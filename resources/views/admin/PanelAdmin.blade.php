@extends('admin.layout.master')
@section('route')
داشبورد
@endsection
@section('main-content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<div class="main-content">
    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> موجودی حساب فعلی </p>
            <p>2,500,000 تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کل فروش دوره ها</p>
            <p>2,500,000 تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p> کارمزد کسر شده </p>
            <p>2,500,000 تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> درآمد خالص </p>
            <p>2,500,000 تومان</p>
        </div>
    </div>
    <div class="row no-gutters font-size-13 margin-bottom-10">
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
    </div>


    <script>

var chartLabels = @json($labels);
var chartData = @json($values);

        document.addEventListener("DOMContentLoaded", function () {
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar', // نوع نمودار (bar, line, pie, etc.)
                data: {
                    labels: chartLabels,
                    datasets: [{
                        label: 'میزان فروش',
                        data: chartData,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>



    <div class="row no-gutters font-size-13 margin-bottom-10">
        <div class="col-8 padding-20 bg-white margin-bottom-10 margin-left-10 border-radius-3">
            <canvas id="myChart" width="400" height="200"></canvas>

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
                        <th>نوع ارسال</th>
                        <th>نوع پرداخت</th>
                        <th>شماره همراه سفارش دهنده</th>
                        <th>تاریخ و ساعت</th>
                        <th>وضعیت</th>
                        <th>عملیات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr role="row">
                            <td><a href="">{{ $order->id }}</a></td>
                            <td><a href="">{{ $order->name }}</a></td>
                            <td><a href="">{{ number_format((float) $order->total_price, 0, '', ',') }}</a></td>
                            <td><a href="">{{ $order->delivery }}</a></td>
                            <td><a href="">{{ $order->payment }}</a></td>
                            <td><a href="">{{ $order->phone }}</a></td>
                            <td><a href="">{{ $order->updated_at }}</a></td>
                            <td>
                                <select class="order-status" data-id="{{ $order->id }}">
                                    <option value="3" {{ $order->status == 3 ? 'selected' : '' }}>سفارش تکمیل شده</option>
                                    <option value="0" {{ $order->status == 0 ? 'selected' : '' }}>سفارش در انتظار پرداخت</option>
                                    <option value="2" {{ $order->status == 2 ? 'selected' : '' }}>سفارش در حال انجام</option>
                                    <option value="1" {{ $order->status == 1 ? 'selected' : '' }}>سفارش در انتظار بررسی</option>
                                    <option value="-1" {{ $order->status == -1 ? 'selected' : '' }}>سفارش لغو شده</option>
                                </select>
                            </td>
                            <td>
                                @if (session('ac') == true)
                                    <a href="{{ route('AdminPanel.Orders.Remove', ['id' => $order->id]) }}" class="item-delete margin-left-10" title="حذف"></a>
                                    <a href="{{ route('AdminPanel.Orders.Edit', ['id' => $order->id, 'status' => $order->status]) }}"
                                       class="item-edit edit-link"
                                       title="ویرایش"
                                       data-id="{{ $order->id }}">
                                    </a>
                                @else
                                    <a>دسترسی ندارید</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                document.querySelectorAll(".item-edit").forEach(editLink => {
                    editLink.addEventListener("click", function(event) {
                        let orderId = this.getAttribute("data-id");  // گرفتن ID سفارش
                        let selectBox = document.querySelector(`.order-status[data-id='${orderId}']`);
                        let selectedValue = selectBox ? selectBox.value : null; // مقدار جدید `status`

                        if (selectedValue !== null) {
                            let urlTemplate = "{{ route('AdminPanel.Orders.Edit', ['id' => '__ID__', 'status' => '__STATUS__']) }}";
                            let updatedUrl = urlTemplate.replace('__ID__', orderId).replace('__STATUS__', selectedValue);

                            console.log("لینک جدید:", updatedUrl); // تست در کنسول

                            // مقدار جدید را در `href` قرار بده
                            this.setAttribute('href', updatedUrl);
                        }
                        // مسیر پیش‌فرض کلیک روی لینک ادامه پیدا کند
                    });
                });
            });
        </script>




    </div>
</div>

@endsection
