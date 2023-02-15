@extends('frontend.business.includes.web')

@section('pageTitle')
{{ 'Tejarh - FAQ' }}
@endsection

@section('content')
<div class="wallet-wrapper cms-bredcrum">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i class="fas fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="my-items-wrapper">
    <div class="container">
       <div class="ja-listing ja-list workingpaper">
          <div class="container">
             <div class="row common">
                <div class="col-md-4 faq-sec">
                   <h1>
                      Frequently Asked Questions (FAQs)
                   </h1>
                   <p>
                      For Additional queries feel free to speak to our center manager at <a href="tel:+91 9999999999">+91
                      9999999999</a> or drop us a
                      mail at <a href="mailto: support@tejarh.com">support@tejarh.com</a>
                   </p>
                   <figure>
                   <img class="w-100" src="{{asset('assets/images/product-img4.png')}}" alt="" />
                   <div class="get-in-touch-sec">
                      <a class="btn-get-in-touch" href="#">
                      </a>
                   </div>
                </div>
                <div class="col-md-8 faq-que">
                   <div class="accordion" id="accordionExample">
                       @php
                        $data = App\Models\Faq::where('status', TRUE)->get(); 
                       @endphp
                      @if (!empty($data))
                        @foreach ($data as $key => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{$key}}">
                                 <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse{{$key}}" aria-expanded="true" aria-controls="collapse{{$key}}">
                                    {{$faq->title}}
                                 </button>
                                </h2>
                                <div id="collapse{{$key}}" class="accordion-collapse collapse show" aria-labelledby="heading{{$key}}"
                                data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <p>{{$faq->description}}</p>
                                </div>
                                </div>
                            </div>  
                        @endforeach
                      @else
                         <div>
                            <p>FAQ is not found</p>
                         </div>
                      @endif
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="try-tejarg-app-wrapper">
    <div class="container">
       <div class="row">
          <div class="col-md-5">
             <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/try-tejarg-app.png ') }}">
          </div>
          <div class="col-md-7">
             <div class="mo-application">
                <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                <ul>
                   <li>
                      <a target="_blank" href="https://www.google.com/">
                      <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/google-play.png ') }}">
                      </a>
                   </li>
                   <li>
                      <a target="_blank" href="https://www.google.com/">
                      <img src="{{ asset(USERS_ASSETS_FOLDER . '/images/app-store.png') }}">
                      </a>
                   </li>
                </ul>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection
@section('script')
@endsection