@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business My Items'}} 
@endsection
@section('content')

    <div class="my-items-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i> Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Trending Items</li>
                        </ol>
                    </nav>                                        
                </div>
                <div class="col-md-7">
                    <div class="my-items-filter">
                        <!-- <ul>
                            <li><a href="#" class="btn">On Sell</a></li>
                            <li><a href="#" class="btn tran_btn">Sold</a></li>
                            <li><a href="#" class="btn tran_btn">Buy</a></li>
                            <li><a href="#" class="btn tran_btn">Booked Items</a></li>                               
                        </ul> -->
                        <h5>Trending Items</h5>
                    </div>                                    
                </div>
            </div>
            <div class="row">                                   
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">Featured</span>
                            <a href="product-details.html">
                                <img src="assets/images/img/product-img1.png">
                            </a>
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <a href="product-details.html">
                                <span class="used-btn">Used</span>
                                <h6>7,000 {{env('CURRENCY_TAG')}}</h6>
                                <p>Apple airpods</p>
                                <p>Jeddah, Saudi Arabia</p>
                                <div class="products-box-footer">
                                    <img src="assets/images/img/product-profile-img.png">
                                    <p>The Full Cart</p>
                                    <i class='product-dots'></i>                                    
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img2.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn unused-btn">UnUsed</span>
                            <h6>58,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Bottle for salon </p>
                            <p>Dammam, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Heaven Space</p>
                                <i class='product-dots disable'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img3.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn new-btn">New</span>
                            <h6>2,900 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple red combo</p>
                            <p>Riyadh, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Handmade & Precious</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">Featured</span>
                            <img src="assets/images/img/product-img1.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn">Used</span>
                            <h6>7,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple airpods</p>
                            <p>Jeddah, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>The Full Cart</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img2.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn unused-btn">UnUsed</span>
                            <h6>58,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Bottle for salon </p>
                            <p>Dammam, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Heaven Space</p>
                                <i class='product-dots disable'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img3.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn new-btn">New</span>
                            <h6>2,900 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple red combo</p>
                            <p>Riyadh, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Handmade & Precious</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">Featured</span>
                            <img src="assets/images/img/product-img1.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn">Used</span>
                            <h6>7,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple airpods</p>
                            <p>Jeddah, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>The Full Cart</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img2.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn unused-btn">UnUsed</span>
                            <h6>58,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Bottle for salon </p>
                            <p>Dammam, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Heaven Space</p>
                                <i class='product-dots disable'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img3.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn new-btn">New</span>
                            <h6>2,900 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple red combo</p>
                            <p>Riyadh, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Handmade & Precious</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>                   
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <span class="featured">Featured</span>
                            <img src="assets/images/img/product-img1.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn">Used</span>
                            <h6>7,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple airpods</p>
                            <p>Jeddah, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>The Full Cart</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img2.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn unused-btn">UnUsed</span>
                            <h6>58,000 {{env('CURRENCY_TAG')}}</h6>
                            <p>Bottle for salon </p>
                            <p>Dammam, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Heaven Space</p>
                                <i class='product-dots disable'></i>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="products-box">
                        <div class="products-box-img">
                            <img src="assets/images/img/product-img3.png">
                            <a href="#" class="wish-list-icon">                                    
                                <i class='bx bxs-heart'></i>
                            </a>
                        </div>
                        <div class="products-box-content">
                            <span class="used-btn new-btn">New</span>
                            <h6>2,900 {{env('CURRENCY_TAG')}}</h6>
                            <p>Apple red combo</p>
                            <p>Riyadh, Saudi Arabia</p>
                            <div class="products-box-footer">
                                <img src="assets/images/img/product-profile-img.png">
                                <p>Handmade & Precious</p>
                                <i class='product-dots'></i>                                    
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#"><</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">></a></li>
                        </ul>
                        </nav>
                </div>                  
            </div>
        </div>
    </div>

    <div class="try-tejarg-app-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/try-tejarg-app.png') }}">
                </div>
                <div class="col-md-7">
                    <div class="mo-application">
                      <h2>@lang('business_messages.menu.try_the_tejrah_app')</h2>
                      <p>@lang('business_messages.menu.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><img
                                src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
@endsection