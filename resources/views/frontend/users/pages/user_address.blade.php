
@extends('frontend.users.layouts.master')

@section('title')
    {{ 'Tejarh - User Address' }}
@endsection

@section('content')
<div class="delivery-order-summary-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('frontend.users.site.index')}}"><i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                        <li class="breadcrumb-item active" aria-current="page">@lang('frontend-messages.header2.address')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
           
            @foreach($userAddressDetail as $key => $detail)
            <div class="col-md-3">
                <div class="delivery-order-address">
                    <p>@lang('frontend-messages.UserAddresses.shippingtxt') <a href="javascript:void(0)"  class="address_data"  data-bs-toggle="modal" id="test" data-bs-target="#edit-delivery-order-summary{{$detail->id}}">@lang('frontend-messages.UserAddresses.changetxt')</a></p>
                    <p>{{$detail->name}}</p>
                    <address>{{$detail->address}}</address>
                    <p>Phone: <a href="tel:{{$detail->phone_number}}">{{$detail->phone_number}}</a></p>

                    @if (!empty($params))
                        <a href="javascript:void(0)" data-uid="{{$detail->user_id}}" data-aid="{{$detail->id}}" data-id="{{$params}}"   class="btn generateInvoice">@lang('frontend-messages.UserAddresses.addressbtn')</a>
                    @else
                        <a href="javascript:void(0)" class="btn">@lang('frontend-messages.UserAddresses.addressbtn')</a>
                    @endif
                </div>
            </div>
            @endforeach           
            <div class="col-md-3">
                <div class="delivery-order-address-add" data-bs-toggle="modal" data-bs-target="#add-delivery-order-summary">
                    <img src="{{asset('assets/images/add-address-icon.png')}}">
                    <h5>@lang('frontend-messages.UserAddresses.add_address')</h5>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Edit Delivery Order Address -->
 @foreach($userAddressDetail as $key => $detail)
<div class="modal fade" id="edit-delivery-order-summary{{$detail->id}}" tabindex="-1"  data_attr_id="{{$detail->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserAddresses.editaddress.title')</h5>
            <div id="ajax-alert-error-edit" class="alert ajax-alert-error-edit" style="display: none;">
            </div>
            <div id="ajax-alert-edit" class="alert ajax-alert-edit" style="display: none;">
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p class="success_address">{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger ">
                    <p>{{ $message }}</p>
                </div>
            @endif
            
            <form action="javascript:void(0)" id="edit_delivery_address{{$detail->id}}">          
                <div class="input-group">                 
                    <input type="hidden" name="id" value="{{$detail->id}}" class="address_id">   
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.name')" class="form-control name" name="name" id="name{{$detail->id}}" value="{{ old('name',$detail->name)}}">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.phonenumber')" class="form-control phone_number" name="phone_number" id="phone_number{{$detail->id}}" value="{{ old('phone_number',$detail->phone_number)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.pincode')" class="form-control pincode" name="pincode" id="pincode{{$detail->id}}" value="{{ old( 'pincode',$detail->pincode)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.locality')" class="form-control locality" name="locality" id="locality{{$detail->id}}" value="{{ old('locality',$detail->locality)}}">
                </div>
                <div class="input-group">
                    <textarea class="form-control address" placeholder="@lang('frontend-messages.UserAddresses.placeholder.address')" id="address{{$detail->id}}" name="address">{{ old('address',$detail->address)}}</textarea>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.city')" class="form-control city" id="city{{$detail->id}}" name="city" value="{{ old('city',$detail->city)}}">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.landmark')" class="form-control landmark" id="landmark{{$detail->id}}" name="landmark" value="{{ old('landmark',$detail->landmark)}}">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.alternatephone')" class="form-control alternate_phone" id="alternate_phone{{$detail->id}}" name="alternate_phone" value="{{ old('alternate_phone',$detail->alternate_phone)}}">
                </div>
                <div class="select-address-type">
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type{{$detail->id}}" id="home{{$detail->id}}" value="home" {{ old('address_type', $detail->address_type) == 'home' ? 'checked' : '' }}>
                        <label class="form-check-label" for="home">
                            @lang('frontend-messages.UserAddresses.editaddress.radiobtn1')
                        </label>
                        </div>
                        <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type{{$detail->id}}" id="home{{$detail->id}}" value="work" {{ old('address_type', $detail->address_type) == 'work' ? 'checked' : '' }}>
                        <label class="form-check-label" for="work">
                        @lang('frontend-messages.UserAddresses.editaddress.radiobtn2')
                        </label>
                        </div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn submit_address loader_class" onclick="AddressUpdate(<?php echo $detail->id; ?>)">@lang('frontend-messages.UserAddresses.editaddress.savebtn')</button>
                    <!-- <input type="submit" data_attr_id2="{{$detail->id}}" class="submit_address btn btn-primary" onclick="AddressUpdate(<?php echo $detail->id; ?>)"  value="@lang('frontend-messages.UserAddresses.editaddress.savebtn')"> -->
                </div> 
            </form>
            {{-- <p><a href="javascript:void(0)" class="cancle">@lang('frontend-messages.UserAddresses.editaddress.cancelbtn')</a></p> --}}
        </div>
    </div>
</div> 
@endforeach

<div class="try-tejarg-app-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{asset('assets/images/try-tejarg-app.png')}}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>                      
                    <ul>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{asset('assets/images/google-play.png')}}"> </a>
                        </li>
                        <li>
                            <a target="_blank" href="https://www.google.com/"><img src="{{asset('assets/images/app-store.png')}}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Delivery Order Address -->
<div class="modal fade" id="add-delivery-order-summary" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close popup-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5>@lang('frontend-messages.UserAddresses.title')</h5>
            <div id="ajax-alert-error" class="alert" style="display: none;">
            </div>
            <div id="ajax-alert" class="alert" style="display: none;">
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <form action="javascript:void(0)" id="users_delivery_address">
                <div class="input-group">
                    <input type="text" value="{{$user->first_name}}" placeholder="@lang('frontend-messages.UserAddresses.placeholder.name')" class="form-control" name="name">
                </div>
                <div class="input-group">
                    <input type="tel" value="{{$user->phone_number}}" placeholder="@lang('frontend-messages.UserAddresses.placeholder.phonenumber')" class="form-control" name="phone_number">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.pincode')" class="form-control" name="pincode" id="pincode" val="">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.locality')" class="form-control" name="locality">
                </div>
                <div class="input-group">
                    <textarea class="form-control" placeholder="@lang('frontend-messages.UserAddresses.placeholder.address')" name="address"></textarea>
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.city')" class="form-control" name="city">
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.UserAddresses.placeholder.landmark')" class="form-control" name="landmark">
                </div>
                <div class="input-group">
                    <input type="tel" placeholder="@lang('frontend-messages.UserAddresses.placeholder.alternatephone')" class="form-control" name="alternate_phone">
                </div>
                <div class="select-address-type">
                    <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type" id="home" value="home">
                        <label class="form-check-label" for="home">
                        @lang('frontend-messages.UserAddresses.placeholder.radiobtn1')
                        </label>
                        </div>
                        <div class="form-check radio-check">
                        <input class="form-check-input" type="radio" name="address_type" id="work" value="work">
                        <label class="form-check-label" for="work">
                        @lang('frontend-messages.UserAddresses.placeholder.radiobtn2')
                        </label>
                        </div>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="btn loader_class">@lang('frontend-messages.UserAddresses.savebtn')</button>
                </div>                    
            </form>
            {{-- <p><a href="javascript:void(0)" class="cancle">@lang('frontend-messages.UserAddresses.cancelbtn')</a></p> --}}
        </div>
    </div>
</div> 
@endsection
@section('script')
<script>
if ($("#users_delivery_address").length > 0) {  
         $("#users_delivery_address").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);  
        },
        rules: {
            "name":{
                required:true,
            },
            "phone_number":{
                required:true,
                number: true,
                minlength:10,
                maxlength:10
            },
            "pincode":{
                required:true,
                number: true,
                minlength:5,
                maxlength:6
            },
            "locality":{
                required:true,
            },
            "address":{
                required:true,
            },
            "city":{
                required:true,
            },
            "address_type":{
                required:true,
            }
        },
        messages: {
            "name":{
                required:'@lang("frontend-messages.UserAddresses.validation.name")',
            },
            "phone_number":{
                required:'@lang("frontend-messages.UserAddresses.validation.phonenumber")',
                number: '@lang("frontend-messages.UserAddresses.validation.validnumber")',
                minlength: '@lang("frontend-messages.UserAddresses.validation.minlengthnumber")',
                maxlength:'@lang("frontend-messages.UserAddresses.validation.maxlengthnumber")'
            }, 
            "pincode":{
                required:'@lang("frontend-messages.UserAddresses.validation.pincode")',
                number: '@lang("frontend-messages.UserAddresses.validation.pincodenumber")',
                minlength: '@lang("frontend-messages.UserAddresses.validation.pincodeminlength")',
                maxlength:'@lang("frontend-messages.UserAddresses.validation.pinmaxlength")'
            }, 
            "locality":{
                required:'@lang("frontend-messages.UserAddresses.validation.locality")',
            }, 
            "address":{
                required:'@lang("frontend-messages.UserAddresses.validation.address")',
            }, 
            "city":{
                required:'@lang("frontend-messages.UserAddresses.validation.city")',
            }, 
            "address_type":{
                required:'@lang("frontend-messages.UserAddresses.validation.addresstype")',
            },            
        },
        submitHandler: function(form) {
            var $this = $('#users_delivery_address .loader_class');
            var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('#users_delivery_address .loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
            $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
                 
    var formdata = new FormData(document.getElementById("users_delivery_address"));  
        $.ajax({
        type:'POST',
        processData: false,
        contentType: false,
        url: "{{ route('frontend.users.profile.add_address')}}",
        data:formdata,
        success:function(data){
            if (data.code === 200) {
                $('#ajax-alert').addClass('alert-success').show(function () {
                    $(this).html(data.success);
                    setTimeout(function() {
                        $('body').removeClass('modal-open');
                        $('.modal').removeClass('show');
                        $('body').css('overflow','visible');
                        $('.modal-backdrop').removeClass('show');
                    }, 2000)
                    $('.loader_class').prop("disabled", false);   
                    var loadingText = '@lang("frontend-messages.UserAddresses.savebtn")';
                    $('.loader_class').prop("disabled", false);
                    $this.html(loadingText);  
                    window.location.href = "";  
                });
           
            }      
        },
        error: function (data) {
            $('#ajax-alert-error').addClass('alert-danger').show(function () {
                $(this).html('@lang("frontend-messages.UserAddresses.error.msg")');
                $('.loader_class').prop("disabled", false);   
                    var loadingText = '@lang("frontend-messages.UserAddresses.savebtn")';
                    $('.loader_class').prop("disabled", false);
                    $this.html(loadingText);  
            });
        }
        });
    }
});
}
</script>
<script>
    function AddressUpdate(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var name = $('#name'+id).val();
        var phone_number = $('#phone_number'+id).val();
        var pincode = $('#pincode'+id).val();
        var locality = $('#locality'+id).val();
        var address = $('#address'+id).val();
        var city = $('#city'+id).val();
        var landmark = $('#landmark'+id).val();
        var alternate_phone = $('#alternate_phone'+id).val();
        var address_type = $("#home"+id+":checked").val();
        // var formdata = new FormData(document.getElementById("edit_delivery_address"));  
        $.ajax({
        type:'POST',      
        url: "{{ url('/profile/update_address')}}/" + id,
        data:{
            id:id,          
            name:name,
            phone_number:phone_number,
            pincode:pincode,
            locality:locality,
            address:address,
            city:city,
            landmark:landmark,
            alternate_phone:alternate_phone,
            address_type:address_type,
        },
        success:function(data){
            if (data.code === 200) {
                $('.ajax-alert-edit').addClass('alert-success').show(function () {
                    $(this).html(data.success);
                    setTimeout(function() {
                        $('body').removeClass('modal-open');
                        $('.modal').removeClass('show');
                        $('body').css('overflow','visible');
                        $('.modal-backdrop').removeClass('show');
                    }, 10000)
                    $('.loader_class').prop("disabled", false);   
                    var loadingText = '@lang("frontend-messages.UserAddresses.editaddress.savebtn")';
                    $('.loader_class').prop("disabled", false);
                    $this.html(loadingText);  
                    window.location.href = "{{ URL::route('frontend.users.profile.add_address') }}";  
                });           
            }      
        },
        error: function (data) {
            $('.ajax-alert-error-edit').addClass('alert-danger').show(function () {
                // alert('hello');
                $(this).html('@lang("frontend-messages.UserAddresses.editaddress.error.msg")');
                $('.loader_class').prop("disabled", false);   
                    var loadingText = '@lang("frontend-messages.UserAddresses.editaddress.savebtn")';
                    $('.loader_class').prop("disabled", false);
                    $this.html(loadingText);  
            });
            // setTimeout(function() {
            //         $('.ajax-alert-error-edit').css('display','none');
            //         $('.ajax-alert-error-edit').removeClass('alert-danger');
            // },3000);            
        }
        });

        //Add User Address validation
        $("#edit_delivery_address"+id).validate({
            ignore: "not:hidden",
                onfocusout: function(element) {
                    this.element(element);  
                },
                rules: {
                    "name":{
                        required:true,
                    },
                    "phone_number":{
                        required:true,
                    },
                    "pincode":{
                        required:true,
                    },
                    "locality":{
                        required:true,
                    },
                    "address":{
                        required:true,
                    },
                    "city":{
                        required:true,
                    },
                    "address_type":{
                        required:true,
                    }
                },
                messages: {
                    "name":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.name")',
                    },
                    "phone_number":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.phonenumber")',
                    }, 
                    "pincode":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.pincode")',
                    }, 
                    "locality":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.locality")',
                    }, 
                    "address":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.address")',
                    }, 
                    "city":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.city")',
                    }, 
                    "address_type":{
                        required:'@lang("frontend-messages.UserAddresses.editaddress.validation.addresstype")',
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
    }
</script>
<script type="text/javascript">

    $('.generateInvoice').click(function() {

        var itemaId = $(this).data('id');
        var userId = $(this).data('uid');
        var addressId = $(this).data('aid');

        $.ajax({

            type: "POST",
            url: "{{ route('mycheckout.index') }}",
            data: {
                item_id: itemaId,
                user_id: userId,
                address_id: addressId,
                _token:'{{ csrf_token() }}'
            },   
            dataType: 'JSON',
            success: function (result) { 

                
                let id =  result.response.id
                let invoiceURL = result.response.invoiceURL

                //let encode_ids = btoa(id); 

                window.location.href = "{{ url('/order-details/checkout') }}/" + id;
                // toastr.success(result.message);
            },
            error: function(err){
                toastr.error("Failed");
            }
        });
    });
</script>
@endsection



