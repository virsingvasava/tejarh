@extends('layouts.app_admin')
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/forms/select/select2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('build/app-assets/vendors/css/vendors.min.css')}}">

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.product.product')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">@lang('messages.product.product_list')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.common.edit')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Tooltip validations start -->
         <section id="tooltip-validation">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title"></h4>
                     </div>
                     <div class="card-body">
                        <form action="{{route('admin.product.update')}}" enctype="multipart/form-data" method="post" id="create_product">
                           @csrf
                           <input type="hidden" name="id" value="{{$edit_products->id}}">
                           <div class="upload_image_section">
                              <div class="row">
                                 <div class="col-12">
                                    <label>@lang('messages.product.create.upload_product_picture')</label>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture1" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.required')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture1 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture1)))
                                          <img id="blah" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture1)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo1.png') }}">
                                          @endif
                                          @else
                                          <img id="blah" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo1.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture1" id="picture1" value="{{old('picture1')}}">
                                    </div>
                                    <div class="picture1_preview"></div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture2" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.image1')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture2 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture2)))
                                          <img id="blah1" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture2)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah1" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo2.png') }}">
                                          @endif
                                          @else
                                          <img id="blah1" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo2.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture2" id="picture2" value="{{old('picture1')}}">
                                    </div>
                                    <div class="picture2_preview"></div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture3" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.image2')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture3 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture3)))
                                          <img id="blah2" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture3)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah2" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo3.png') }}">
                                          @endif
                                          @else
                                          <img id="blah2" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo3.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture3" id="picture3" value="{{old('picture3')}}">
                                    </div>
                                    <div class="picture3_preview"></div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture4" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.image3')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture4 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture4)))
                                          <img id="blah3" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture4)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah3" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo4.png') }}">
                                          @endif
                                          @else
                                          <img id="blah3" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo4.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture4" id="picture4" value="{{old('picture4')}}">
                                    </div>
                                    <div class="picture4_preview"></div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture5" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.image4')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture5 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture5)))
                                          <img id="blah4" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture5)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah4" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo5.png') }}">
                                          @endif
                                          @else
                                          <img id="blah4" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo5.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture5" id="picture5" value="{{old('picture5')}}">
                                    </div>
                                    <div class="picture5_preview"></div>
                                 </div>
                                 <div class="col-4">
                                    <div class="form-group" id="product_img">
                                       <label for="picture6" class="btn btn-default or_upload" id="pro1">@lang('messages.product.create.image5')
                                          @if($edit_products_image)
                                          @if($edit_products_image->item_picture6 != '' && file_exists(public_path('assets/post/'.$edit_products_image->item_picture6)))
                                          <img id="blah5" class="product_icon" src="{{asset('assets/post/'.$edit_products_image->item_picture6)}}" alt="Profile Picture" height="100" width="100" />
                                          @else
                                          <img id="blah5" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo6.png') }}">
                                          @endif
                                          @else
                                          <img id="blah5" height="100" width="100" class="product_icon" src="{{ asset('assets/images/post-img- upload-photo6.png') }}">
                                          @endif
                                          <br>
                                       </label>
                                       <input type="file" height="100" width="100" class="form-control" name="item_picture6" id="picture6" value="{{old('picture6')}}">
                                    </div>
                                    <div class="picture6_preview"></div>
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-12 mb-12">
                                 <label for="product_name">@lang('messages.product.create.product_name')</label>
                                 <input type="text" class="form-control @error('what_are_you_selling') is-invalid @enderror" name="what_are_you_selling" id="product_name" value="{{$edit_products->what_are_you_selling}}" placeholder="@lang('messages.product.create.product_name')">
                                 @error('product_name')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="col-md-12 mb-12 d-block mt-1">
                                 <label for="selling_description">@lang('messages.product.description')</label>
                                 <fieldset class="form-label-group">
                                    <textarea class="form-control {{ $errors->has('describe_your_items') ? 'has-error' : '' }}" name="describe_your_items" id="label-textarea" rows="2" placeholder="@lang('messages.product.create.what_are_you_selling')">{{ $edit_products->describe_your_items }}</textarea>
                                 </fieldset>
                                 @error('selling_description')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <div class="col-md-12 mb-12">
                                 <label for="name">@lang('messages.product.create.details')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select" name="category_id" id="categoryArr">
                                       @foreach ($category as $cate)
                                       <option value="{{ $cate->id }}" {{$cate->id == $edit_products->category_id  ? 'selected' : ''}}>{{ $cate->category_name}}</option>
                                       @endforeach
                                    </select>
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <select class="custom-select" name="sub_category_id" id="subcategoryList">
                                       <option value="">@lang('messages.product.create.select_subcategory')</option>
                                       @foreach($sub_category as $key => $cate)
                                       <option value="{{$cate->id}}" {{$cate->id == $edit_products->sub_category_id  ? 'selected' : ''}}>{{ $cate->sub_cate_name }}
                                       </option>
                                       @endforeach
                                    </select>
                                 </fieldset>

                                 <fieldset class="form-group">
                                    <select class="custom-select" name="brand_id" id="brandList">
                                       <option value="">@lang('messages.product.create.select_brand')</option>
                                       @foreach($brand as $key => $cate)
                                       <option value="{{$cate->id}}" {{$cate->id == $edit_products->brand_id  ? 'selected' : ''}}>{{ $cate->name }}
                                       </option>
                                       @endforeach
                                    </select>
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('attribute_id') is-invalid @enderror" name="attribute_id" id="attributeList">
                                       <option value="">Select Attribute</option>
                                    </select>
                                    @error('attribute_id')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <select class="select2 form-group @error('attribute_variant_id') is-invalid @enderror" name="attribute_variant_id" multiple="multiple" id="attribute_variantList">
                                       <option value="">Select Attribute Variant</option>
                                    </select>
                                    @error('attribute_variant_id')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('condition_id') is-invalid @enderror" name="condition_id" id="conditionList">
                                       @foreach ($condition as $con)
                                       <option value="{{ $con->id }}" {{$con->id == $edit_products->condition_id  ? 'selected' : ''}}>{{ $con->name }}</option>
                                       @endforeach
                                    </select>
                                    @error('condition_id')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <input type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" id="weight" value="{{$edit_products->weight}}" placeholder="@lang('messages.product.create.enter_weight')">
                                    @error('weight')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <input type="text" class="form-control @error('width') is-invalid @enderror" name="width" id="width" value="{{$edit_products->width}}" placeholder="@lang('messages.product.create.enter_width')">
                                    @error('width')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <input type="text" class="form-control @error('length') is-invalid @enderror" name="length" id="length" value="{{$edit_products->length}}" placeholder="@lang('messages.product.create.enter_length')">
                                    @error('length')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <input type="text" class="form-control @error('height') is-invalid @enderror" name="height" id="height" value="{{$edit_products->height}}" placeholder="@lang('messages.product.create.enter_height')">
                                    @error('height')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                                 <fieldset class="form-group">
                                    <select class="custom-select  @error('quantity') is-invalid @enderror" name="quantity">
                                       @foreach ($quantityArray as $qty)
                                       <option value="{{ $qty }}" {{$qty == $edit_products->quantity  ? 'selected' : ''}}>{{ $qty }}</option>
                                       @endforeach
                                    </select>
                                    @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                              <div class="col-md-12 mb-12">
                                 <label for="name"> @lang('messages.product.create.ship_form')</label>
                                 <input type="text" class="form-control @error('address') is-invalid @enderror" value="{{ $edit_products->address }}" id="searchfield" name="address" placeholder="Address">
                                 <input id="lat" type="hidden" name="lat">
                                 <input id="lng" type="hidden" name="lng"><br>
                                 <div class="row">
                                    <div class="col-md-12">
                                       <div class="wrapper-map">
                                          <div id="map"></div>
                                       </div>
                                    </div>
                                 </div>
                                 @error('zip_code')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                              <!-- <div class="col-md-12 mb-12 d-block mt-1">
                                 <label for="status">@lang('messages.product.create.ship_mode')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select  @error('ship_mode_id') is-invalid @enderror" name="ship_mode_id">
                                       <option value="">@lang('messages.product.create.ship_by_courier')</option>
                                       @foreach ($ship_mode as $key => $value)
                                       <option value="{{ $value->id }}" {{$value->id == $edit_products->ship_mode_id  ? 'selected' : ''}}>{{ $value->name }}</option>
                                       @endforeach
                                    </select>
                                    @error('ship_mode_id')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div> -->
                              <div class="col-md-12 mb-12 d-block mt-1">
                                 <label for="status">@lang('business_messages.post_an_item.delivery_type')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select  @error('delivery_type') is-invalid @enderror" name="delivery_type">
                                       <option value="" selected disabled>@lang('frontend-messages.post_item.select_delivery_type')</option>
                                       <<<<<<< HEAD <option @if($edit_products->delivery_type == "within 2-3 days") selected="selected" @endif value="within 2-3 days">@lang('frontend-messages.post_item.within_2_days')</option>
                                          <option @if($edit_products->delivery_type == "within 7 days") selected="selected" @endif value="within 7 days">@lang('frontend-messages.post_item.within_7_days')</option>
                                          =======
                                          @foreach ($delivey_type as $key => $value)
                                          <option value="{{ $value->id }}" {{$value->id == $edit_products->delivery_type  ? 'selected' : ''}}>{{ $value->name }}</option>
                                          @endforeach
                                          >>>>>>> 6dfc55ad53bd11666e9da47d3a71596d807ccaed
                                    </select>
                                    @error('delivery_type')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                           </div>
                           <div><label>@lang('messages.product.create.what_do_you_want_to_pay_for_shiping')</label></div>
                           <div class="row">
                              <div class="col-4">
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="the_buyer" name="pay_shipping" value="0" {{ ($edit_products->pay_shipping=="0")? "checked" : "" }}>@lang('messages.product.create.the_buyer')
                                    <label class="form-check-label" for="pay_shipping"></label>
                                 </div>
                              </div>
                              <div class="col-4">
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="iwill_pay" name="pay_shipping" value="1" {{ ($edit_products->pay_shipping=="1")? "checked" : "" }}>@lang('messages.product.create.ill_pay')
                                    <label class="form-check-label" for="pay_shipping"></label>
                                 </div>
                              </div>
                              <div class="col-4">
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="split" name="pay_shipping" value="2" {{ ($edit_products->pay_shipping=="2")? "checked" : "" }}>@lang('messages.product.create.split')
                                    <label class="form-check-label" for="pay_shipping"></label>
                                 </div>
                              </div>
                           </div>
                           <div class="d-block mt-1"><label>@lang('messages.product.create.select_price_type')</label></div>
                           <div class="row">
                              <div class="col-4">
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="fixed_price" name="price_type" value="0" {{ ($edit_products->price_type=="0")? "checked" : "" }}>@lang('messages.product.create.fixed_price')
                                    <label class="form-check-label" for="price_type"></label>
                                 </div>
                              </div>
                              <div class="col-4">
                                 <div class="form-check">
                                    <input type="radio" class="form-check-input" id="negotiable" name="price_type" value="1" {{ ($edit_products->price_type=="1")? "checked" : "" }}>@lang('messages.product.create.negotiable')
                                    <label class="form-check-label" for="price_type"></label>
                                 </div>
                              </div>
                           </div>
                           <div class="form-row">
                              <div class="col-md-12 mb-12 d-block mt-1">
                                 <label for="price">@lang('messages.product.create.pricing')</label>
                                 <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" id="price" value="{{$edit_products->price}}" placeholder="@lang('messages.product.create.1200sar')">
                                 @error('price')
                                 <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                 </span>
                                 @enderror
                              </div>
                           </div>
                           <div class="d-block mt-1">
                              <div class="row">
                                 <div class="col-4">
                                    <label for="commission_charge"><span>@lang('messages.product.create.commission_charge')</span></label>
                                 </div>
                                 <div class="col-4"> <span> - @lang('messages.product.create.100sar')</span>
                                    <input type="hidden" name="commission_charge" value="100 SAR">
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-4">
                                    <label for="shipping_charge"><span>@lang('messages.product.create.shipping_charge')</span></label>
                                 </div>
                                 <div class="col-4">
                                    <span> - @lang('messages.product.create.100sar')</span>
                                    <input type="hidden" name="shipping_charge" value="100 SAR">
                                 </div>
                              </div>
                              <hr>
                              <div class="row">
                                 <div class="col-4">
                                    <label for="total"><span><strong>@lang('messages.product.create.total')</strong></span></label>
                                 </div>
                                 <div class="col-4">
                                    <span> <strong>@lang('messages.product.create.1000sar')</strong></span>
                                    <input type="hidden" name="total" value="1000 SAR">
                                 </div>
                              </div>
                           </div>
                           <div class="form-row d-block mt-1">
                              <div class="col-md-12 mb-12">
                                 <label for="status">@lang('messages.common.select_status')</label>
                                 <fieldset class="form-group">
                                    <select class="custom-select @error('status') is-invalid @enderror" name="status">
                                       <option value="">@lang('messages.common.select_status')</option>
                                       <option @if($edit_products->status == 1) selected="selected" @endif value="1">@lang('messages.common.active')</option>
                                       <option @if($edit_products->status == 0) selected="selected" @endif value="0">@lang('messages.common.In_active')</option>
                                    </select>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                 </fieldset>
                              </div>
                           </div>


                           <div class="col-12 d-flex justify-content-start">
                              <button type="submit" class="btn btn-primary mr-1">@lang('messages.common.submit')</button>
                              <a href="{{route('admin.product.index')}}" class="btn btn-light-secondary btn_loader">@lang('messages.common.cancel')</a>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!-- Tooltip validations end -->
      </div>
   </div>
</div>
<!-- END: Content-->

<style type="text/css">
   label.or_upload {
      border: 1px solid #DFE3E7;
      border-radius: 0.267rem;
      padding: 10px;
   }

   #picture1 {
      display: none;
      background-color: #000;
   }

   #picture2 {
      display: none;
      background-color: #000;
   }

   #picture3 {
      display: none;
      background-color: #000;
   }

   #picture4 {
      display: none;
      background-color: #000;
   }

   #picture5 {
      display: none;
      background-color: #000;
   }

   #picture6 {
      display: none;
      background-color: #000;
   }


   #icon {
      /*width: 100px;*/
      cursor: pointer;
   }
</style>


<style type="text/css">
   label {
      font-size: 0.9rem;
      text-transform: initial;
   }

   img.or_product_Images_wh {
      /* margin-top: 20px;
    margin-right: 20px;*/
      height: 150px;
      width: 150px;
   }

   .file-upload {
      border: 1px solid #DFE3E7;
      border-radius: 0.267rem;
      overflow: hidden;
      position: relative;
   }

   .file-upload input {
      height: calc(1.4em + 0.94rem + 3.7px);
      padding: 0.47rem 0.8rem;
      left: -200px;
      top: -200px;
      background: transparent;
      /*opacity:0;*/
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
      filter: alpha(opacity=0);
      color: #fff;
      background-color: #fff;
   }

   .file-upload img {
      height: 70px;
      width: 70px;
      margin: 15px;
   }
</style>


<script type="text/javascript">
   $("#create_product").validate({
      ignore: "not:hidden",
      onfocusout: function(element) {
         this.element(element);
      },
      rules: {
         "picture1": {
            required: true,
         },
         "product_name": {
            required: true,
         },

         "selling_description": {
            required: true,
         },

         "describe_description": {
            required: true,
         },

         "category_id": {
            required: true,
         },

         "sub_category_id": {
            required: true,
         },

         "brand_id": {
            required: true,
         },

         "condition_id": {
            required: true,
         },


         "weight": {
            required: true,
         },

         "quantity": {
            required: true,
         },

         "zip_code": {
            required: true,
         },

         "ship_mode_id": {
            required: true,
         },

         "price": {
            required: true,
         },

         "status": {
            required: true,
         },
      },
      messages: {

         "picture1": {
            required: '{{__("messages.product.create.validation.choose_product_picture")}}',
         },

         "product_name": {
            required: '{{__("messages.product.create.validation.please_enter_name")}}',
         },

         "selling_description": {
            required: '{{__("messages.product.create.validation.please_enter_selling_description")}}',
         },

         "describe_description": {
            required: '{{__("messages.product.create.validation.please_enter_product_description")}}',
         },

         "category_id": {
            required: '{{__("messages.product.create.validation.please_select_category")}}',
         },

         "sub_category_id": {
            required: '{{__("messages.product.create.validation.please_select_sub_category")}}',
         },

         "brand_id": {
            required: '{{__("messages.product.create.validation.please_select_brand")}}',
         },

         "condition_id": {
            required: '{{__("messages.product.create.validation.please_select_condition")}}',
         },

         "weight": {
            required: '{{__("messages.product.create.validation.please_enter_weight")}}',
         },

         "quantity": {
            required: '{{__("messages.product.create.validation.please_select_qty")}}',
         },

         "zip_code": {
            required: '{{__("messages.product.create.validation.please_enter_input_zip_code")}}',
         },

         "ship_mode_id": {
            required: '{{__("messages.product.create.validation.please_select_ship_mode")}}',
         },

         "price": {
            required: '{{__("messages.product.create.validation.please_enter_pricing")}}',
         },

         "status": {
            required: '{{__("messages.product.create.validation.please_select_status")}}',
         },

      },
      submitHandler: function(form) {
         var $this = $('.loader_class');
         var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
         $('.loader_class').prop("disabled", true);
         $this.html(loadingText);
         form.submit();
      }
   });
</script>

<script type="text/javascript">
   $(function() {
      picture1.onchange = evt => {
         const [file] = picture1.files
         if (file) {
            blah.src = URL.createObjectURL(file)
         }
      }

      picture2.onchange = evt => {
         const [file] = picture2.files
         if (file) {
            blah1.src = URL.createObjectURL(file)
         }
      }

      picture3.onchange = evt => {
         const [file] = picture3.files
         if (file) {
            blah2.src = URL.createObjectURL(file)
         }
      }

      picture4.onchange = evt => {
         const [file] = picture4.files
         if (file) {
            blah3.src = URL.createObjectURL(file)
         }
      }

      picture5.onchange = evt => {
         const [file] = picture5.files
         if (file) {
            blah4.src = URL.createObjectURL(file)
         }
      }

      picture6.onchange = evt => {
         const [file] = picture6.files
         if (file) {
            blah5.src = URL.createObjectURL(file)
         }
      }

      var imagesPreview2 = function(input, placeToInsertImagePreview) {
         if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();

               reader.onload = function(event) {
                  $($.parseHTML('<img class="or_product_Images_wh">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
               }
               reader.readAsDataURL(input.files[i]);
            }
         }
      };
      $('#picture2').on('change', function() {
         imagesPreview2(this, 'label#pro2');
      });

      var imagesPreview3 = function(input, placeToInsertImagePreview) {
         if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();

               reader.onload = function(event) {
                  $($.parseHTML('<img class="or_product_Images_wh">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
               }
               reader.readAsDataURL(input.files[i]);
            }
         }
      };
      $('#picture3').on('change', function() {
         imagesPreview3(this, 'label#pro3');
      });

      var imagesPreview4 = function(input, placeToInsertImagePreview) {
         if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();

               reader.onload = function(event) {
                  $($.parseHTML('<img class="or_product_Images_wh">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
               }
               reader.readAsDataURL(input.files[i]);
            }
         }
      };
      $('#picture4').on('change', function() {
         imagesPreview4(this, 'label#pro4');
      });

      var imagesPreview5 = function(input, placeToInsertImagePreview) {
         if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();

               reader.onload = function(event) {
                  $($.parseHTML('<img class="or_product_Images_wh">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
               }
               reader.readAsDataURL(input.files[i]);
            }
         }
      };
      $('#picture5').on('change', function() {
         imagesPreview5(this, 'label#pro5');
      });

      var imagesPreview6 = function(input, placeToInsertImagePreview) {
         if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
               var reader = new FileReader();

               reader.onload = function(event) {
                  $($.parseHTML('<img class="or_product_Images_wh">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
               }
               reader.readAsDataURL(input.files[i]);
            }
         }
      };
      $('#picture6').on('change', function() {
         imagesPreview6(this, 'label#pro6');
      });
   });

   $(document).ready(function() {
      $('#categoryArr').change(function() {
         var category_id = $(this).val();
         var token = "{{csrf_token()}}";
         $.ajax({
            url: "{{ route('admin.product.sub_category_listing') }}",
            type: "POST",
            data: {
               category_id: category_id,
               _token: token
            },
            success: function(res) {
               $('#subcategoryList').html('<option value=""> --- Select --- </option>');
               $.each(res, function(key, value) {
                  $('#subcategoryList').append('<option value="' + value
                     .id + '">' + value.sub_cate_name + '</option>');
               });
            }
         })
      });

      $('#subcategoryList').change(function() {
         var sub_category_id = $(this).val();
         var token = "{{csrf_token()}}";
         $.ajax({
            url: "{{ route('admin.product.brand_listing') }}",
            type: "POST",
            data: {
               sub_category_id: sub_category_id,
               _token: token
            },
            success: function(res) {
               $('#brandList').html('<option value=""> --- Select --- </option>');
               $.each(res, function(key, value) {
                  $('#brandList').append('<option value="' + value
                     .id + '">' + value.name + '</option>');
               });
            }
         })
      });

      $('#brandList').change(function() {
         var brand_id = $(this).val();
         var token = "{{csrf_token()}}";
         $.ajax({
            url: "{{ route('admin.product.condition_listing') }}",
            type: "POST",
            data: {
               brand_id: brand_id,
               _token: token
            },
            success: function(res) {
               $('#conditionList').html('<option value=""> --- Select --- </option>');
               $.each(res, function(key, value) {
                  $('#conditionList').append('<option value="' + value
                     .id + '">' + value.name + '</option>');
               });
            }
         })
      });
   });
</script>
<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('build/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
<script src="{{asset('build/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{asset('build/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtaxhnhdFp0QXoWnKkn-tyjaoX5YIsjx0&libraries=places"></script>
<script>
   let Map = {
      mapContainer: document.getElementById('map'),
      inputAutocomplete: document.getElementById('searchfield'),
      inputLat: $("input[name=lat]"),
      inputLng: $("input[name=lng]"),
      map: {},
      geocoder: new google.maps.Geocoder(),
      autocomplete: {},
      init: function() {
         let _this = this;

         this.autocomplete = new google.maps.places.Autocomplete(this.inputAutocomplete);

         let latLng = new google.maps.LatLng(-23.6815314, -46.875502);
         console.log(this.inputLat.val());
         if (this.inputLat.val() && this.inputLng.val()) {
            latLng = new google.maps.LatLng(this.inputLat.val(), this.inputLng.val());
         }

         this.map = new google.maps.Map(this.mapContainer, {
            zoom: 15,
            center: latLng
         });

         this.autocomplete.addListener('place_changed', function() {
            let place = _this.autocomplete.getPlace();

            _this.inputLat.val(place.geometry.location.lat());
            _this.inputLng.val(place.geometry.location.lng());

            let latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());

            // create marker
            let marker = new google.maps.Marker({
               position: latlng,
               map: _this.map,
               draggable: true
            });
            _this.map.setCenter(latlng);

            marker.addListener('dragend', function() {
               _this.inputLat.val(marker.getPosition().lat());
               _this.inputLng.val(marker.getPosition().lng());
               _this.geocodePosition(marker.getPosition());
               _this.map.setCenter(marker.getPosition());
            })
         })
      },
      geocodePosition: function(pos) {
         let _this = this;
         console.log(pos);
         this.geocoder.geocode({
            latLng: pos
         }, function(responses) {
            if (responses && responses.length > 0) {
               _this.updateMarkerAddress(responses[0].formatted_address);
            } else {
               _this.updateMarkerAddress('Nenhuma coordenada encontrada');
            }
         });
      },
      updateMarkerAddress: function(str) {
         this.inputAutocomplete.value = str;
      },
      renderMap: function($el) {
         let _this = this;
         let $markers = $el.find('.marker');

         let args = {
            zoom: 16,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false
         };

         let map = new google.maps.Map($el[0], args);

         map.markers = [];

         $markers.each(function() {
            _this.add_marker($(this), map);
         });

         _this.center_map(map);
      },
      add_marker: function($marker, map) {
         let latlng = new google.maps.LatLng($marker.attr('data-lat'), $marker.attr('data-lng'));
         let marker = new google.maps.Marker({
            position: latlng,
            map: map
         });
         map.markers.push(marker);
      },
      center_map: function(map) {
         let bounds = new google.maps.LatLngBounds();

         $.each(map.markers, function(i, marker) {
            let latlng = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
            bounds.extend(latlng);
         });

         if (map.markers.length == 1) {
            map.setCenter(bounds.getCenter());
            map.setZoom(16);
         } else {
            map.fitBounds(bounds);
         }
      },
   };

   $(document).ready(function() {
      Map.init();
   });
</script>
<style type="text/css">
   .wrapper-map {
      width: 100%;
      height: 330px;
   }

   #map {
      width: 100%;
      height: 100%;
   }
</style>
@endsection