@extends('frontend.business.includes.web')
@section('pageTitle') 
    {{'Tejarh - Business Edit Profile'}} 
@endsection
@section('content')
<div class="add-store-wrapper">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{route('frontend.business.home.index')}}"><i class="fas fa-home"></i>@lang('business_messages.menu.home')</a></li>
                  <li class="breadcrumb-item"><a href="javascript:void(0)">@lang('business_messages.menu.profile')</a></li>
                  <li class="breadcrumb-item active" aria-current="page">@lang('business_messages.profile.edit.edit_profile')</li>
               </ol>
            </nav>
         </div>
      </div>
      <form action="{{route('frontend.business.business-profile.updateProfile')}}" enctype="multipart/form-data" method="post" id="b_edit_profile">
         @csrf
         <input type="hidden" name="id" value="{{$edit_profile->user->id}}">
         <div class="row">
            <div class="col-md-12">
               <div class="input-group file-upload">
                  <div class="file-upload-div">
                        <input type="file" onchange="readURL01(this);" name="profile_picture">
                        @if(isset(Auth::user()->profile_picture) && !empty(Auth::user()->profile_picture))
                        <img id="blah01" src="{{asset(BUSINESS_PROFILE_FOLDER.'/'.Auth::user()->profile_picture)}}"> 
                        @else
                        <img id="blah01" src="{{asset('assets/images/Uploading-Story.png')}}"> 
                        @endif
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="user_id" value="{{$edit_profile->user->username}}" placeholder="username" class="form-control" readonly>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="company_name" value="{{$edit_profile->company_name}}" placeholder="@lang('business_messages.profile.edit.company_name')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="company_legal_name" value="{{$edit_profile->company_legal_name}}" placeholder="@lang('business_messages.profile.edit.company_legal_name')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="owner_or_manager_name" value="{{$edit_profile->owner_or_manager_name}}" placeholder="@lang('business_messages.profile.edit.owner_manager_name')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="number" name="enter_cr_number" value="{{$edit_profile->enter_cr_number}}" placeholder="@lang('business_messages.profile.edit.owner_manager_name')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="upload_cr_file" value="{{$edit_profile->upload_cr}}" placeholder="@lang('business_messages.profile.edit.upload_cr')" class="form-control">
                  <h5> 
                     @php 
                        $file1 = $edit_profile->upload_cr
                     @endphp 
                     @if(!empty($file1))
                           {{$edit_profile->upload_cr}}
                     @else 
                        @lang('business_messages.profile.edit.upload_cr') 
                     @endif
                  </h5>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="number" name="enter_cr_maroof_namber" value="{{$edit_profile->enter_cr_maroof_namber}}" placeholder="@lang('business_messages.profile.edit.enter_maroof_number')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="upload_maroof_file" value="{{$edit_profile->upload_maroof}}" placeholder="@lang('business_messages.profile.edit.upload_maroof')" class="form-control">
                  <h5>
                     @php 
                        $file2 = $edit_profile->upload_maroof
                     @endphp 
                     @if(!empty($file2))
                           {{$edit_profile->upload_maroof}}
                     @else 
                        @lang('business_messages.profile.edit.upload_maroof') 
                     @endif
                     </h5>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="date" name="date_of_expiry" value="{{$edit_profile->date_of_expiry}}" placeholder="@lang('business_messages.profile.edit.date_of_expiry')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="number" name="vat_number" value="{{$edit_profile->vat_number}}" placeholder="@lang('business_messages.profile.edit.enter_vat_number')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="vat_certificate_file" value="{{$edit_profile->vat_certificate_file}}" placeholder="@lang('business_messages.profile.edit.vat_certificate')" class="form-control">
                  <h5>   
                     @php 
                        $file3 = $edit_profile->vat_certificate_file
                     @endphp 
                     @if(!empty($file3))
                           {{$edit_profile->vat_certificate_file}}
                     @else 
                         @lang('business_messages.profile.edit.upload_vat') 
                     @endif
                  </h5>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="bank_name" value="{{$edit_profile->bank_name}}" placeholder="@lang('business_messages.profile.edit.bank_name')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="number" name="bank_account_number" value="{{$edit_profile->bank_account_number}}" placeholder="@lang('business_messages.profile.edit.bank_account_number')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="Iban_number" value="{{$edit_profile->Iban_number}}" placeholder="@lang('business_messages.profile.edit.IBAN_number')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="business_email" value="{{$edit_profile->user->email}}" placeholder="@lang('business_messages.profile.edit.business_email')" class="form-control" readonly>
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group mobile-number">
                  <div class="ph-code">
                        <select class="form-select" name="phone_number_code">
                           <option selected value="1">+966</option>
                           <!-- <option value="1">+971</option> -->
                        </select>
                  </div>
                  <div class="ph-no">
                        <input type="text" name="phone_number" value="{{$edit_profile->user->phone_number}}" placeholder="@lang('business_messages.profile.edit.enter_business_phone_number')" class="form-control" readonly>
                  </div>
                  <label id="getPhoneNumber-error" class="error" for="getPhoneNumber"></label>
               </div>
            </div>

            
            <!-- <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="store_name" value="{{$edit_profile->store_name}}"  placeholder="@lang('business_messages.profile.edit.store_name')" class="form-control">
               </div>
            </div> -->
            <!-- <div class="col-md-4">
               <div class="input-group location-icon">
                  <input type="text" name="store_location" value="{{$edit_profile->store_location}}" placeholder="@lang('business_messages.profile.edit.store_location')" class="form-control">
               </div>
            </div> -->
            <!-- <div class="col-md-4">
               <div class="input-group">
                  <select class="form-select" name="branch_id">
                     <option value="" selected>@lang('business_messages.profile.edit.select_branch')</option>
                     @if (!empty($branches)) 
                        @foreach($branches as $key => $branch)
                        <option value="{{$branch->id}}" {{$branch->id == $edit_profile->branch_id  ? 'selected' : ''}} >{{$branch->name}}</option>
                        @endforeach
                     @endif
                  </select>
                  <label id="branch_id-error" class="error" for="branch_id"></label>
               </div>
            </div> -->
          
            <div class="col-md-4">
                    <div class="input-group">
                        <select class="form-select" name="country_id" id="country-dropdown">
                            <option value="" selected>@lang('business_messages.profile.edit.select_country')</option>
                            @foreach (App\Models\Country::all() as $country) 
                            <option value="{{$country->id}}" {{$country->id == $edit_profile->country_id  ? 'selected' : ''}}>
                                {{$country->name}}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('country_id'))
                        <span class="text-danger">{{ $errors->first('country_id') }}</span>
                        @endif   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group">    
                        <select class="form-select state-dropdown" name="state_id" id="state-dropdown">
                           @foreach (App\Models\State::all() as $state) 
                            <option value="{{$state->id}}" {{$state->id == $edit_profile->state_id  ? 'selected' : ''}}>
                                {{$state->name}}
                            </option>
                           @endforeach
                        </select>
                        @if ($errors->has('state_id'))
                        <span class="text-danger">{{ $errors->first('state_id') }}</span>
                        @endif                                   
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group"> 
                        <select class="form-select city-dropdown" name="city_id" id="city-dropdown"> 
                           @foreach (App\Models\City::all() as $city) 
                            <option value="{{$city->id}}" {{$city->id == $edit_profile->city_id  ? 'selected' : ''}}>
                                {{$city->name}}
                            </option>
                           @endforeach
                        </select>
                        <label id="city_id-error" class="error" for="city_id"></label>
                        @if ($errors->has('city_id'))
                            <span class="text-danger">{{ $errors->first('city_id') }}</span>
                        @endif
                    </div>
                </div>

            <!-- <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="shop_sign_file" value="{{$edit_profile->shop_sign_file}}" placeholder="@lang('business_messages.profile.edit.shop_sign')" class="form-control">
                  <h5>   
                     @php 
                           $file3 = $edit_profile->shop_sign_file
                     @endphp 
                     @if(!empty($file3))
                           {{$edit_profile->shop_sign_file}}
                     @else 
                         @lang('business_messages.profile.edit.upload_shop_sign')
                     @endif
                  </h5>
               </div>
            </div> -->
            <!-- <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="store_logo_file" value="{{$edit_profile->store_logo_file}}" placeholder="@lang('business_messages.profile.edit.store_logo')" class="form-control">
                  <h5>   
                     @php 
                        $file3 = $edit_profile->store_logo_file
                     @endphp 
                     @if(!empty($file3))
                           {{$edit_profile->store_logo_file}}
                     @else 
                        @lang('business_messages.profile.edit.upload_store_logo')
                     @endif
                  </h5>
               </div>
            </div> -->
            
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="working_hours" value="{{$edit_profile->working_hours}}" placeholder="@lang('business_messages.profile.edit.working_hours')" class="form-control">
               </div>
            </div>
            <div class="col-md-4">
               <div class="input-group">
                  <input type="text" name="website" value="{{$edit_profile->website}}" placeholder="@lang('business_messages.profile.edit.website')" class="form-control">
               </div>
            </div>
            <!-- <div class="col-md-4">
               <div class="input-group">
                  <select class="form-select" name="store_type_id">
                     <option value="" selected>@lang('business_messages.profile.edit.store_types')</option>
                     @if (!empty($stores)) 
                        @foreach($stores as $key => $store)
                        <option value="{{$store->id}}" {{$store->id == $edit_profile->store_type  ? 'selected' : ''}}>{{$store->name}}</option>
                        @endforeach
                     @endif
                  </select>
                  <label id="store_type_id-error" class="error" for="store_type_id"></label>
               </div>
            </div> -->
            <div class="col-md-4">
               <div class="input-group file-upload-icon">
                  <input type="file" name="ministry_of_government" value="{{$edit_profile->ministry_of_government}}" placeholder="@lang('business_messages.profile.edit.ministry_of_government')" class="form-control" accept="application/pdf,application/doc,application/docx">
                  <h5>   
                     @php 
                        $file3 = $edit_profile->ministry_of_government
                     @endphp 
                     @if(!empty($file3))
                           {{$edit_profile->ministry_of_government}}
                     @else 
                        @lang('business_messages.profile.edit.ministry_of_government')
                     @endif
                  </h5>
               </div>
            </div>
            <div class="col-md-12">
               <div class="form-group submit col-md-4">
                  <input type="submit" class="btn btn-primary" value="@lang('business_messages.profile.edit.save')">
               </div>
            </div>
            
      </form>
      </div>
      </form>
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

<script type="text/javascript">
$("#b_edit_profile").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
   rules: {
      "company_name": {
         required: true,
      },
      "company_legal_name": {
         required: true,
      },
      "owner_manager_name": {
         required: true,
      },
      "cr_number": {
         required: true,
      },
      // "upload_cr_file": {
      // 	required: true,
      // },
      "enter_maroof_number": {
         required: true,
      },
      // "upload_maroof_file": {
      // 	required: true,
      // },
      "date_of_expiry": {
         required: true,
      },
      // "vat_certificate_file": {
      // 	required: true,
      // },
      "return_policy": {
      	required: true,
      },
      "bank_name": {
         required: true,
      },
      "bank_account_number": {
         required: true,
      },
      "iban_number": {
         required: true,
      },
      "business_email": {
         required: true,
      },
      "phone_number": {
         required: true,
         number: true,
         minlength: 10,
         maxlength: 10
      },
      "store_name": {
         required: true,
      },
      "store_location": {
         required: true,
      },
      "branch_id": {
         required: true,
      },
      "city_area": {
         required: true,
      },
      "district": {
         required: true,
      },
      "country": {
         required: true,
      },
      "city_id": {
         required: true,
      },
      // "shop_sign_file": {
      //    required: true,
      // },
      // "store_logo_file": {
      //    required: true,
      // },
      "store_phone_number": {
         required: true,
      },
      "working_hours": {
         required: true,
      },
      "website": {
         required: true,
      },
      "store_type_id": {
         required: true,
      },
   },
   messages: {

      "company_name": {
         required:'{{__("business_messages.register.business_user.validation.company_name")}}',
      },
      "company_legal_name": {
         required:'{{__("business_messages.register.business_user.validation.company_legal_name")}}',
      },
      "owner_manager_name": {
         required:'{{__("business_messages.register.business_user.validation.owner_manager_name")}}',
      },
      "cr_number": {
         required:'{{__("business_messages.register.business_user.validation.cr_number")}}',
      },
      // "upload_cr_file": {
      // 	required:'{{__("business_messages.register.business_user.validation.upload_cr_file")}}',
      // },
      "enter_maroof_number": {
         required:'{{__("business_messages.register.business_user.validation.enter_maroof_number")}}',
      },
      // "upload_maroof_file": {
      // 	required:'{{__("business_messages.register.business_user.validation.upload_maroof_file")}}',
      // },
      "date_of_expiry": {
         required:'{{__("business_messages.register.business_user.validation.date_of_expiry")}}',
      },
      // "vat_certificate_file": {
      // 	required:'{{__("business_messages.register.business_user.validation.vat_certificate")}}',
      // },
      // "return_policy": {
      // 	required:'{{__("business_messages.register.business_user.validation.return_policy")}}',
      // },
      "bank_name": {
         required:'{{__("business_messages.register.business_user.validation.bank_name")}}',
      },
      "bank_account_number": {
         required:'{{__("business_messages.register.business_user.validation.bank_account_number")}}',
      },
      "iban_number": {
         required:'{{__("business_messages.register.business_user.validation.iban_number")}}',
      },
      "business_email": {
         required:'{{__("business_messages.register.business_user.validation.business_email")}}',
      },
      "phone_number": {
         required:'{{__("business_messages.register.business_user.validation.phone_number")}}',
         number: '@lang("business_messages.register.business_user.validation.validnumber")}}',
         minlength: '@lang("business_messages.register.business_user.validation.minlengthnumber")}}',
         maxlength: '@lang("business_messages.register.business_user.validation.maxlengthnumber")'
      },
      "store_name": {
         required:'{{__("business_messages.register.business_user.validation.store_name")}}',
      },
      "store_location": {
         required:'{{__("business_messages.register.business_user.validation.location")}}',
      },
      "branch_id": {
         required:'{{__("business_messages.register.business_user.validation.branch_id")}}',
      },
      "city_area": {
         required:'{{__("business_messages.register.business_user.validation.city_area")}}',
      },
      "country": {
         required:'{{__("business_messages.register.business_user.validation.country")}}',
      },
      "city_id": {
         required:'{{__("business_messages.register.business_user.validation.city_id")}}',
      },
      // "shop_sign_file": {
      //    required:'{{__("business_messages.register.business_user.validation.shop_sign_file")}}',
      // },
      // "store_logo_file": {
      //    required:'{{__("business_messages.register.business_user.validation.store_logo_file")}}',
      // },
      "store_phone_number": {
         required:'{{__("business_messages.register.business_user.validation.store_phone_number")}}',
      },
      "working_hours": {
         required:'{{__("business_messages.register.business_user.validation.working_hours")}}',
      },
      "website": {
         required:'{{__("business_messages.register.business_user.validation.website")}}',
      },
      "store_type_id": {
         required:'{{__("business_messages.register.business_user.validation.store_type_id")}}',
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


<!-- get states by country Id -->
<script type="text/javascript">    
 $(document).ready(function() {
    $('select[name="state_id"]').append('<option value="">Select State</option>'); 
    $('select[name="state_id"]').niceSelect('update'); 
    $('select[name="country_id"]').on('change', function() {
        var country_id = this.value;
        if(country_id) {
            $.ajax({
                url: '{{route('frontend.business.business-profile.state_listing')}}',
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function(response) {                       
                    $('select[name="state_id"]').empty();
                    $('select[name="state_id"]').append('<option value="">Select State</option>');        
                    $.each(response.states, function(key, value) {
                        $('select[name="state_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('select[name="state_id"]').niceSelect('update'); 
                }
            });
        }else{
            $('select[name="state_id"]').empty();
        }
    });
});
</script>
<!-- get cities by state id -->
<script type="text/javascript">    
 $(document).ready(function() {
    $('select[name="city_id"]').append('<option value="">Select City</option>'); 
    $('select[name="city_id"]').niceSelect('update'); 
    $('select[name="state_id"]').on('change', function() {
        var state_id = this.value;
        if(state_id) {
            $.ajax({
                url: '{{route('frontend.business.business-profile.city_listing')}}',
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success:function(response) {                       
                    $('select[name="city_id"]').empty();
                    $('select[name="city_id"]').append('<option value="">Select City</option>');        
                    $.each(response.cities, function(key, value) {
                        $('select[name="city_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                    $('select[name="city_id"]').niceSelect('update'); 
                }
            });
        }else{
            $('select[name="city_id"]').empty();
        }
    });
});
</script>
@endsection