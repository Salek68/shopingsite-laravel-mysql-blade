<!doctype html>
<html>
   <head>
      <meta charset="utf-8">
      <title>@yield('title')</title>
      <link href="{{ asset('style/font-awesome.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('style/bootstrap.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('style/owl.carousel.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('style/owl.theme.default.css') }}" rel="stylesheet" type="text/css">
      <link href="{{ asset('style/style.css') }}" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="social">
         <ul>
            <li><a href=""><i class="fa fa-instagram"></i></a></li>
            <li><a href=""><i class="fa fa-send"></i></a></li>
            <li><a href=""><i class="fa fa-facebook"></i></a></li>
            <li><a href=""><i class="fa fa-twitter"></i></a></li>
         </ul>
      </div>
      <!---------------------------------->
      <div class="top2">
         <div class="container">
            <div class="row">
               <div class="col-md-6">
                  <div class="login">
                     <a href="{{route('Register.index')}}" class="mybtn"><i class="fa fa-user-plus"></i>ثبت نام</a>
                     <a href="{{route('Login.index')}}" class="mybtn"><i class="fa fa-user-o"></i>ورود</a>
                     <a href="{{route('cart.index')}}" class="mybtn"><i class="fa fa-cart-arrow-down"></i>سبد</a>
                  </div>
               </div>
               <div class="col-md-6">
                  <form action="" >
                     <input type="text" placeholder="کالای مورد نظر را جستجو کنید">
                     <button type="submit" ><i class="fa fa-search"></i></button>
                  </form>
               </div>
            </div>
         </div>
      </div>
      </div><!--top2-->
      <!---------------------------------->
      <div class="main-menu">

         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <ul style="direction: ltr;">

                    @foreach ($menu1 as $menu)


                    <li>

                        <a href="#">{{ $menu->name }}</a>
                        <ul>

                            @foreach ($menu->submenus as $submenu)
                            <li><a href="#">{{ $submenu->name }} </a></li>
                                {{-- <li>
                                    <strong>{{ $submenu->name }}</strong><br>
                                    <img src="{{ asset('images/' . $submenu->img) }}" alt="{{ $submenu->name }}" />
                                </li> --}}
                            @endforeach
                        </ul>
                     </li>








                @endforeach
                <li><a href="{{route('index')}}">صفحه نخست<a></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <br>



@yield('container')



      <!---------------------------------->
      <div class="footer">
         <div class="container">
            <div class="row">
               <div class="col-md-5">
                  <div class="footer-description">
                     <ul>
                        <li>تضمین اصالت کالاهای فروخته شده</li>
                        <li>فروش برند های معتبر</li>
                        <li>پاسخگویی 24 ساعته</li>
                        <li>امکان پرداخت آنلاین با کارت بانکی و پرداخت در محل</li>
                        <li>امکان بازگشت تا یک هفته در صورت عدم رضایت مشتری</li>
                        <li>خرید آسان و مطمئن</li>
                        <li>قیمت های مناسب</li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="footer-description2">
                     <ul>
                        <li><i class="fa fa-truck"></i>تحویل پستی سریع</li>
                        <li><i class="fa fa-plane"></i>ارسال با پست پیشتاز و سفارشی</li>
                        <li><i class="fa fa-cart-arrow-down"></i>خرید آسان و راحت</li>
                     </ul>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="news-form">
                     <h5>در خبرنامه عضو شوید</h5>
                     <form action="" >
                        <input type="email" placeholder="ایمیل خود را وارد کنید" >
                        <button type="submit" ><i class="fa fa-envelope-o"></i></button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!---------------------------------->
      <div class="copy-right">
         <div class="container">
            <div class="row">
               <div class="col-md-12 text-center">
                  &copy;&nbsp;&nbsp;طراحی و کدنویسی  صالح کشاورز&nbsp;&nbsp;&nbsp;&nbsp;

               </div>
            </div>
         </div>
      </div>
      <!---------------------------------->
      <script src="{{ asset('js/jquery-3.3.1.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/owl.carousel.min.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/bootstrap.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/jquery.simple.timer.js') }}" type="text/javascript"></script>
      <script src="{{ asset('js/js.js') }}" type="text/javascript"></script>
   </body>
</html>
