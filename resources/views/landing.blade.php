@extends('layout.master')

@section('container')
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="slider-box">
             <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                   <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                   <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    @if ($slider1 != null)

                    @isset($slider1)

                    @php $isActive = true; @endphp

                    @foreach ($slider1 as $slide)
                    @php
                    $formattedPrice = number_format((float)$slide["price"], 0, '', ',');
                @endphp
                        <div class="carousel-item {{ $isActive ? 'active' : '' }}">
                            <div class="col-md-6" style="padding-top: 20px;">
                                <h4>{{ $slide["name"] }}</h4>
                                <span>{{$formattedPrice }} ریال</span>
                                <p>{{ $slide["description"] }}</p>
                            </div>
                            <div class="col-md-6">
                           <a href="{{ route('singelproduct', ['id' => $slide['id']]) }}">     <img src="img/{{$slide['image']}}" class="w-75"></a>
                            </div>
                        </div>
                        @php $isActive = false; @endphp
                    @endforeach
                    @endisset

                    @else
                        محصولی برای نمایش نیست
                    @endif


                   {{-- <div class="carousel-item">
                      <div class="col-md-6" style="padding-top: 20px;">
                         <h4>Huawei Tab G45</h4>
                         <span>تبلت جی 5 هوآوی</span>
                         <p>تبلت 10 اینج هوآوی . با قابلیت نصب سه عدد سیمکارت همزمان . دارای شبکه فورجی و اتصال سریع . دارای باتری اتمی و دوربین 13 مگاپیکسل</p>
                      </div>
                      <div class="col-md-6">
                         <img src="img/p20lite-listimage-black.png" class="w-75" >
                      </div>
                   </div> --}}
                </div>
             </div>
          </div>
          <!--slider-box-->
       </div>
    </div>
 </div>
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-3">
          <div class="coopen">
             <img src="img/coopen.png" class="w-100" />
          </div>
       </div>
       <div class="col-md-9">
        @if ($featuredProduct != null)



          <div class="vizheh">
             <div class="col-md-6">
                <div class="vizheh-img">
                 <a href="{{ route('singelproduct', ['id' => $featuredProduct->id]) }}">  <img src="img/{{$featuredProduct->image}}" class="w-100" /></a>
                </div>
             </div>
             <div class="col-md-6">
                <div class="vizheh-content">

                   <div><del>{{ number_format($featuredProduct->price, 0, '', ',') }}</del></div>
                   <h4>{{ number_format($featuredProduct->price -(($featuredProduct->price * $featuredProduct->discount)/100) , 0, '', ',') }}</h4>
                   <h3> {{$featuredProduct->name}}</h3>
                   <ul>
                      <li>   {{$featuredProduct->description}} </li>

                   </ul>
                   <hr>
                   <span>زمان باقیمانده تا پایان سفارش</span>
                   <div class="counter" data-minutes-left="1000"></div>
                </div>
             </div>
             <div class="vizheh-tag">
                <span>فرصت ویژه</span>
             </div>
          </div>
          @else
          محصولی برای نمایش نیست
      @endif
       </div>
    </div>
 </div>
 <!---------------------------------->

 <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="three-slider">
             <h4>محصولات پر بازدید</h4>
             <div class="owl-carousel owl-theme ov1">

                @if ($upview != null)



            @foreach ($upview as $up)







                        <div class="item">
                            <figure>
                                <a href="{{ route('singelproduct', ['id' => $up->id]) }}"><img src="img/{{$up->image}}" class="w-100" /></a>
                             </figure>
                            <h5>{{ $up->name }}</h5>
                            {{-- <p><strong>دسته‌بندی:</strong> {{ $result->category_name }} - {{ $result->zir_menu_name }}</p> --}}
                            <p><strong>قیمت:</strong> {{ number_format($up->price) }} ریال</p>
                            <p><strong>توضیحات:</strong> {!! nl2br(e($up->description)) !!}</p>
                        </div>

                @endforeach

                @else
                محصولی برای نمایش نیست
            @endif

             </div>


            </div>

        </div>
    </div>
 </div>


 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">

        @foreach ($baners as $baner)

        @if ($baner->position === 'b1')
        <div class="book-baner">
            <a href=""><img src="img/{{$baner->image}}" class="w-100" /></a>
            <h4> {{ $baner->name }}</h4>
         </div>
        @endif
    @endforeach

       </div>
    </div>
 </div>
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="two-slider">




                @php
                $ov2Printed = false;
            @endphp

            @foreach ($results as $result)
                @if (!$ov2Printed && $result->position === 'ov2')
                  <h4> {{ $result->category_name }} - {{ $result->zir_menu_name }}</h4>
                  <div class="owl-carousel owl-theme ov2">
                    @php
                        $ov2Printed = true;
                    @endphp
                @endif
               {{-- <h4> {{ $results->0->zir_menu_name }} < {{ $results['category_name'] }}</h4> --}}


                    @if ($result->position === 'ov2' && $result->product_id != null)
                        <div class="item">
                            <figure>
                                <a href="{{ route('singelproduct', ['id' => $result->product_id]) }}"><img src="img/{{$result->image}}" class="w-100" /></a>
                             </figure>
                            <h5>{{ $result->product_name }}</h5>
                            {{-- <p><strong>دسته‌بندی:</strong> {{ $result->category_name }} - {{ $result->zir_menu_name }}</p> --}}
                            <p><strong>قیمت:</strong> {{ number_format($result->product_price) }} ریال</p>
                            <p><strong>توضیحات:</strong> {!! nl2br(e($result->product_description)) !!}</p>
                        </div>
                    
                    @endif
                @endforeach


            </div>
       </div>
    </div>
 </div>
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">
        @foreach ($baners as $baner)

        @if ($baner->position === 'b2')
        <div class="book-baner">
            <a href=""><img src="img/{{$baner->image}}" class="w-100" /></a>
            <h4> {{ $baner->name }}</h4>
         </div>
        @endif
    @endforeach
       </div>
    </div>
 </div>
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="one-slider">
            @php
    $ov1Printed = false;
@endphp

@foreach ($results as $result)
    @if (!$ov1Printed && $result->position === 'ov1')
      <h4> {{ $result->category_name }} - {{ $result->zir_menu_name }}</h4>
      <div class="owl-carousel owl-theme ov1">
        @php
            $ov1Printed = true;
        @endphp
    @endif
   {{-- <h4> {{ $results->0->zir_menu_name }} < {{ $results['category_name'] }}</h4> --}}


        @if ($result->position === 'ov1')
            <div class="item">
                <figure>
                    <a href="{{ route('singelproduct', ['id' => $result->product_id]) }}"><img src="img/{{$result->image}}" class="w-100" /></a>
                 </figure>
                <h5>{{ $result->product_name }}</h5>
                {{-- <p><strong>دسته‌بندی:</strong> {{ $result->category_name }} - {{ $result->zir_menu_name }}</p> --}}
                <p><strong>قیمت:</strong> {{ number_format($result->product_price) }} ریال</p>
                <p><strong>توضیحات:</strong> {!! nl2br(e($result->product_description)) !!}</p>
            </div>
        @endif
    @endforeach
            {{-- @foreach ($result as $item)

    @if (!empty($item['products']))
        <ul>
            @foreach ($item['products'] as $product)

                <div class="item">
                   <figure>
                      <a href=""><img src="img/{{$product->image}}" class="w-100" /></a>
                   </figure>
                   <h5>{{$product->name}}</h5>
                   <span>{{$product->price}}</span>
                </div>
            @endforeach
        </ul>
    @else
        <p>محصولی یافت نشد.</p>
    @endif
@endforeach --}}

             {{-- <div class="owl-carousel owl-theme ov1">
                <div class="item">
                   <figure>
                      <a href=""><img src="img/Canon_EOS_400D.png" class="w-100" /></a>
                   </figure>
                   <h5>canon-ef-50mm</h5>
                   <span>1,200,000 تومان</span>
                </div>

             </div> --}}
          </div>
       </div>
    </div>
 </div>
 <!---------------------------------->

 <!---------------------------------->


@endsection
