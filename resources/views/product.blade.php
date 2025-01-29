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
             <a href="#"><i class="fa fa-cart-plus"></i>خرید آنلاین</a>
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
نظری وجود ندارد...

@endsection
