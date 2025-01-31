@extends('layout.singel')

@section('box')
<div class="single-box">
    <div class="row">
       <div class="col-md-7">
          <h5>{{$product->name}}</h5>
          <hr>
          <div class="row">
             <div class="col-md-7">
                <div class="single-content-right">
                   <ul class="brand-ul">

                      <li>دسته بندی : <a href="#"> {{$product->category_name}} </a></li>
                   </ul>
                   <br>
                   <span>مشخصات مختصر محصول :</span><br>
                   <ul class="product-ul">
                      <li></li>
                      <li>{{$product->description}}   </li>
                      <li>   شناسه کالا : {{$product->sku}}</li>
                      <li>
                        تعداد بازدید : {{$product->view}}

                      </li>
                      <li>
                        تعداد فروش : {{$product->sold}}

                      </li>

                </div>
             </div>
             <div class="col-md-5">
                <div class="single-content-left">
                   <ul>
                      <span>وضعیت :@if ($product->stock > 0)
                        {{$product->stock}}  موجود در انبار

                        @else
                            اتمام موجودی
                        @endif

                    </span><br><br>
                    @php
                    use Carbon\Carbon;
                        $updatedAt = Carbon::parse($product->updated_at);
                        $diffInDays = $updatedAt->diffInDays(Carbon::now());
                    @endphp
                      <li>اخرین تعغیر  :@if ($diffInDays<=7)
                       به تازگی

                        @else
                            مدتی پیش
                        @endif </li>
                      <br>

                   </ul>
                </div>
             </div>
          </div>
          <hr>
          @if ($product->discount > 0)
          <del><h3>{{number_format((float)$product->price, 0, '', ',');}}  ریال</h3></del>
          <h3>{{ number_format($product->price -(($product->price * $product->discount)/100) , 0, '', ',') }}</h3>
          @else
          <h3>{{number_format((float)$product->price, 0, '', ',');}}  ریال</h3>
          @endif

          <div  class="btn-single">
            <div class="product-details">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                    <a href="{{route('cart.index')}}">مشاهده سبد خرید</a>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

                <!-- فرم انتخاب تعداد -->
                <form action="{{ route('cart.add', $product->id) }}" method="GET">
                    <div class="form-group">
                        <label for="quantity">تعداد</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>

                    <!-- دکمه افزودن به سبد خرید -->
                    <button type="submit" class="btn btn-success">افزودن به سبد خرید</button>
                </form>
            </div>
          </div>
       </div>
       <div class="col-md-5">
          <div class="single-img">
             <figure>
                <img src="{{asset('img/' . $product->image)}}" class="w-100 s-img" data-zoom-image="img/single-tablet.jpg">
             </figure>
          </div>
          <div class="single-img-slider">
             <div class="owl-carousel owl-theme ov-single">
                @foreach ($galery as $g)
                <div class="item">

                    <a data-fancybox="gallery"  href="{{ asset('img/' . $g->image) }}"><img src="{{ asset('img/' . $g->image) }}" class="w-100"></a>


                </div>
                @endforeach
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

@section('releated')
<div class="row">
    <div class="col-md-12">
       <div class="single-two-slider">
          <div class="owl-carousel owl-theme ov-single-two">
            @foreach ($rlated as $item)


             <div class="item">
                <figure>
                   <a href="{{ route('singelproduct', ['id' => $item->id]) }}"><img style="width: 200px; height: 200px; display: block; object-fit: contain;" src="{{ asset('img/' . $item->image) }}" class="w-100" /></a>
                </figure>
                <h5>{{ $item->name}}</h5>
                <span>{{number_format((float)$item->price, 0, '', ',');}}  ریال</span>
             </div>
     @endforeach
          </div>
       </div>
    </div>
 </div>
@endsection

@section('one_fani')
@foreach ($vigeis as $item)
<p class="bg-light"><span>{{$item->name}}:</span>{{$item->description}}</p>

@endforeach


@endsection


@section('two_nazar')



<div class="container mt-5">
    <h2 class="text-center">ثبت نظر</h2>

    <!-- نمایش پیام بعد از ارسال نظر -->
    @if (session('status'))
        <script>
            alert("{{ session('status') }}")
        </script>
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- فرم ثبت نظر -->
    <form action="{{ route('storecomment',$product->id ) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="comment">نظر شما:</label>
            <textarea name="comment" id="comment" class="form-control" rows="4" required placeholder="نظر خود را وارد کنید..."></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">ارسال نظر</button>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(".like-btn").click(function() {
            var commentId = $(this).data("id");
            var button = $(this);

            $.ajax({
                url: "/Product/" + commentId + "/like",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        button.find(".like-count").text(response.likes);
                    }
                }
            });
        });

        $(".dislike-btn").click(function() {
            var commentId = $(this).data("id");
            var button = $(this);

            $.ajax({
                url: "/Product/" + commentId + "/dislike",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        button.find(".dislike-count").text(response.dislike);
                    }
                }
            });
        });
    });
</script>

@if ($Comments->isNotEmpty())
<ul class="space-y-4">
    @foreach ($Comments as $item)
        <li class="p-4 bg-white shadow rounded-lg flex justify-between items-center">
            <div>
                <p class="text-lg font-semibold">{{ $item->comment }}</p>
                <small class="text-gray-500">توسط {{ $item->user->name ?? 'مهمان' }}</small>
            </div>
            <div class="flex space-x-2">
                <button class="like-btn flex items-center px-3 py-1 text-green-600 border border-green-600 rounded-lg hover:bg-green-600 hover:text-white"
                        data-id="{{ $item->id }}">
                    👍 <a class="like-count">{{ $item->like }}</a>
                </button>
                <button class="dislike-btn flex items-center px-3 py-1 text-red-600 border border-red-600 rounded-lg hover:bg-red-600 hover:text-white"
                        data-id="{{ $item->id }}">
                    👎  <a class="dislike-count">{{ $item->dislike }}</a>
            </div>
        </li>
    @endforeach
</ul>

@else
    <p class="text-center text-muted">هیچ نظری وجود ندارد.</p>
@endif


@endsection
