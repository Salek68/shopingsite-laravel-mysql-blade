@extends('layout.master')
@section('container')
<div class="container">
    <div class="row">
       <div class="col-md-12">

       @yield('box')
       </div>
    </div>
 </div>
 <!---------------------------------->
 <div class="container">
    <span class="releated-products">محصولات مرتبط</span>
    <hr>
    @yield('releated')
 </div>
 <!---------------------------------->
 <div class="container">
    <div class="row">
       <div class="col-md-12">
          <div class="single-tabs">
             <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#one"><i class="fa fa-file"></i>مشخصات فنی</a></li>
                <li><a data-toggle="tab" href="#two"><i class="fa fa-pencil"></i>نظرات کاربران</a></li>
             </ul>
             <div class="tab-content">
                <div id="one" class="tab-pane fade">
                   @yield('one_fani')
                </div>
                <div id="two" class="tab-pane fade">
                  @yield('two_nazar')
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
