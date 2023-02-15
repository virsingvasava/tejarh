@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Sell Item' }}
@endsection

@section('content')
<div class="post-an-item-wrapper">
    <h4>@lang('frontend-messages.post_item.post_an_item')</h4>
    <div class="post-an-item-form">
        <form action="{{ route('frontend.users.post-items.store') }}" enctype="multipart/form-data" method="post" id="user_item_an_post">
            @csrf
            <div class="img-upload border-bottom">
                <label>@lang('frontend-messages.post_item.upload_item_picture')</label>
                <ul>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL1(this);" name="item_picture1" />
                                <img src="{{ asset('assets/images/post-img- upload-photo1.png') }}" id="post-item-img1">
                            </div>
                            <div class="error_message">
                                <label id="item_picture1-error" class="error" for="item_picture1"></label>
                                @if ($errors->has('item_picture1'))
                                <span class="text-danger">{{ $errors->first('item_picture1') }}</span>
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL2(this);" name="item_picture2" />
                                <img src="{{ asset('assets/images/post-img- upload-photo2.png') }}" id="post-item-img2">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL3(this);" name="item_picture3" />
                                <img src="{{ asset('assets/images/post-img- upload-photo3.png') }}" id="post-item-img3">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL4(this);" name="item_picture4" />
                                <img src="{{ asset('assets/images/post-img- upload-photo4.png') }}" id="post-item-img4">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL5(this);" name="item_picture5" />
                                <img src="{{ asset('assets/images/post-img- upload-photo5.png') }}" id="post-item-img5">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL6(this);" name="item_picture6" />
                                <img src="{{ asset('assets/images/post-img- upload-photo6.png') }}" id="post-item-img6">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="description border-bottom">
                <label>@lang('frontend-messages.post_item.description')</label>
                <div class="input-group">
                    <input type="text" placeholder="SKU" name="sku" value="{{ old('sku') }}" class="form-control">
                    @if ($errors->has('sku'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('sku') }}</span></div>
                    @endif
                </div>

                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.post_item.placeholder.what_are_you_selling')" name="item_description" value="{{ old('item_description') }}" class="form-control">
                    @if ($errors->has('item_description'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('item_description') }}</span></div>
                    @endif
                </div>

                <div class="input-group">
                    <textarea class="form-control" name="describe_your_items" placeholder="@lang('frontend-messages.post_item.placeholder.describe_your_items')">{{ old('describe_your_items') }}</textarea>
                    @if ($errors->has('describe_your_items'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('describe_your_items') }}</span></div>
                    @endif
                </div>

            </div>
            <div class="details border-bottom">
                <label>@lang('frontend-messages.post_item.details') <span> *@lang('frontend-messages.post_item.fields_add_as_per_category') </span></label>
                <div class="input-group">
                    <select class="form-select category-h" name="category_id">
                        <option value="">@lang('frontend-messages.post_item.select_category')</option>
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}">
                            @if (App::isLocale('en'))
                                <span>{{ $cat->category_name }}</span>
                            @else
                                <span>{{ $cat->ar_category_name }}</span>
                            @endif
                        </option>
                        @endforeach
                    </select>
                    <label id="category_id-error" class="error" for="category_id"></label>
                    @if ($errors->has('category_id'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('category_id') }}</span></div>
                    @endif
                </div>
                <div class="input-group">
                    <select class="form-select" name="subcat_id" id="subcat_id">
                    </select>
                    <label id="subcat_id-error" class="error" for="subcat_id"></label>
                    @if ($errors->has('subcat_id'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('subcat_id') }}</span></div>
                    @endif
                </div>
                <div class="input-group">
                    <select class="form-select" name="brand_id" id="brand_id">
                    </select>
                    <label id="brand_id-error" class="error" for="brand_id"></label>
                    @if ($errors->has('brand_id'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('brand_id') }}</span></div>
                    @endif
                </div>
                <div class="input-group">
                    <select class="form-select" name="attribute_id" id="attribute_id">
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="attribute_variants_id" id="attribute_variants_id">
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="condition_id">
                        @if (!empty($condition) && count($condition))
                        @foreach ($condition as $key => $value)
                        <option value="{{ $value->id }}">
                            @if (App::isLocale('en'))
                                {{ $value->name }}
                            @else
                                {{ $value->ar_name }}
                            @endif
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <label id="condition_id-error" class="error" for="condition_id"></label>
                    @if ($errors->has('condition_id'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('condition_id') }}</span></div>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" placeholder="@lang('frontend-messages.post_item.placeholder.enter_weight')" name="enter_weight" class="form-control">
                    @if ($errors->has('enter_weight'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('enter_weight') }}</span></div>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="width" value="{{ old('width') }}" placeholder="@lang('frontend-messages.post_item.placeholder.width')" class="form-control">
                    @if ($errors->has('width'))
                    <span class="text-danger">{{ $errors->first('width') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="length" value="{{ old('length') }}" placeholder="@lang('frontend-messages.post_item.placeholder.length')" class="form-control">
                    @if ($errors->has('length'))
                    <span class="text-danger">{{ $errors->first('length') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="height" value="{{ old('height') }}" placeholder="@lang('frontend-messages.post_item.placeholder.height')" class="form-control">
                    @if ($errors->has('height'))
                    <span class="text-danger">{{ $errors->first('height') }}</span>
                    @endif
                </div>
                <div class="input-group">
                <input type="text" name="qty_id" value="{{ old('height') }}" placeholder="Enter QTY" class="form-control">
                    @if ($errors->has('qty_id'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('qty_id') }}</span></div>
                    @endif
                </div>
            </div>
            <div class="ship-from border-bottom">
                <label>@lang('frontend-messages.post_item.ship_from')</label>
                <div class="input-group">
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchfield" name="ship_from" placeholder="Address">
                        <input id="lat" type="hidden" name="lat">
                        <input id="lng" type="hidden" name="lng">
                        <label id="ship_from-error" class="error" for="ship_from"></label>
                        @if ($errors->has('ship_from'))
                        <span class="text-danger">{{ $errors->first('ship_from') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper-map">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ship-mode border-bottom">
                <label>@lang('frontend-messages.post_item.delivery_type')</label>
                <div class="input-group">
                    <select class="form-select" name="delivery_type">
                        <option value="" selected disabled>@lang('frontend-messages.post_item.select_delivery_type')</option>
                        @if (!empty($delivery_type) && count($delivery_type))
                        @foreach ($delivery_type as $key => $value)
                        <option value="{{ $value->id }}">
                            @if (App::isLocale('en'))
                                {{ $value->name }}
                            @else
                                {{ $value->ar_name }}
                            @endif
                        </option>
                        @endforeach
                        @endif
                    </select>
                    @if ($errors->has('delivery_type'))
                    <span class="text-danger">{{ $errors->first('delivery_type') }}</span>
                    @endif
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('frontend-messages.post_item.who_do_you_want_to_pay_for_shipping')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="pay_shipping" id="the-buyer">
                    <label class="form-check-label" for="the-buyer">@lang('frontend-messages.post_item.the_buyer')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="pay_shipping" id="i-will-pay" checked>
                    <label class="form-check-label" for="i-will-pay">@lang('frontend-messages.post_item.i_will_buy')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="2" name="pay_shipping" id="split" checked>
                    <label class="form-check-label" for="split">@lang('frontend-messages.post_item.split')</label>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('frontend-messages.post_item.select_price_type')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="price_type" id="fixed-price" checked>
                    <label class="form-check-label" for="fixed-price">@lang('frontend-messages.post_item.fixed_price') </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="price_type" id="negotiable" checked>
                    <label class="form-check-label" for="negotiable">@lang('frontend-messages.post_item.negotiable')</label>
                </div>
            </div>
            <div class="pricing">
                <label>@lang('frontend-messages.post_item.pricing')</label>
                <div class="input-group">
                    <input type="text" placeholder="1200 {{env('CURRENCY_TAG')}}" id="price" name="price" value="{{ old('price') }}" class="form-control">
                    @if ($errors->has('price'))
                    <div class="or-error-message"><span class="text-danger">{{ $errors->first('price') }}</span></div>
                    @endif
                </div>
                <table>
                    <tr>
                        <td>@lang('frontend-messages.post_item.commission_charge')</td>
                        <input type="hidden" id="commision_data" name="commission_charge"  value="{{$commission_user}}">
                        <td>-{{$commission_user}} {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <!-- <tr>
                        <td>@lang('frontend-messages.post_item.shipping_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr> -->
                    <tr>
                        <td>@lang('frontend-messages.post_item.total')</td>
                        <input type="hidden" id="total_price" name="total_amount"  >
                        <td id="total_price_td"> {{env('CURRENCY_TAG')}}</td>
                    </tr>
                </table>
            </div>
            <div class="submit-post">
                <div class="input-group">
                    <input type="submit" class="form-control btn" value="@lang('frontend-messages.post_item.post_your_item')">
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


<!-- get subcategory by category -->
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="subcat_id"]').append('<option value="">@lang("frontend-messages.post_item.select_subcategory")</option>');
        $('select[name="subcat_id"]').niceSelect('update');
        $('select[name="category_id"]').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    url: "{{ url('/post-items/subcat')}}/" + categoryID,
                    //url: "{{ url('/subcat') }}/" + categoryID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcat_id"]').empty();
                        $('select[name="subcat_id"]').append(
                            '<option value="">@lang("frontend-messages.post_item.select_subcategory")</option>');
                        $.each(data, function(key, value) {
                            $('select[name="subcat_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                        $('select[name="subcat_id"]').niceSelect('update');
                    }
                });
            } else {
                $('select[name="subcat_id"]').empty();
            }
        });
    });
</script>
<!-- get brand by sub category -->
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="brand_id"]').append('<option value="">@lang("frontend-messages.post_item.select_brand")</option>');
        $('select[name="brand_id"]').niceSelect('update');
        $('select[name="subcat_id"]').on('change', function() {
            var subCatID = $(this).val();
            if (subCatID) {
                $.ajax({
                    url: "{{ url('/post-items/brand')}}/" + subCatID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="brand_id"]').empty();
                        $('select[name="brand_id"]').append(
                            '<option value="">@lang("frontend-messages.post_item.select_brand")</option>');
                        $.each(data, function(key, value) {
                            $('select[name="brand_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                        $('select[name="brand_id"]').niceSelect('update');
                    }
                });
            } else {
                $('select[name="brand_id"]').empty();
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="attribute_id"]').append('<option value="">{{__("select Attribute")}}</option>');
        $('select[name="attribute_id"]').niceSelect('update');
        $('select[name="subcat_id"]').on('change', function() {
            var subCatID = $(this).val();
            var token = "{{csrf_token()}}";
            if (attribute_id) {
                $.ajax({
                    url: '{{route("frontend.users.post-items.getAttribute")}}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'subcat_id': subCatID,
                        _token: token
                    },
                    success: function(data) {
                        $('select[name="attribute_id"]').empty();
                        $('select[name="attribute_id"]').append('<option value="">{{__("Select Attribute")}}</option>');
                        $.each(data, function(key, value) {
                            $('select[name="attribute_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                        $('select[name="attribute_id"]').niceSelect('update');
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="attribute_variants_id"]').append('<option value="">{{__("select Attribute Variants")}}</option>');
        $('select[name="attribute_variants_id"]').niceSelect('update');
        $('select[name="attribute_id"]').on('change', function() {
            var attribute_id = $(this).val();
            var token = "{{csrf_token()}}";
            if (attribute_id) {
                $.ajax({
                    url: '{{route("frontend.users.post-items.getAttributevariants")}}',
                    type: "POST",
                    dataType: "json",
                    data: {
                        'attribute_id': attribute_id,
                        _token: token
                    },
                    success: function(data) {
                        $('select[name="attribute_variants_id"]').empty();
                        $('select[name="attribute_variants_id"]').append('<option value="">{{__("Select Attribute Variants")}}</option>');
                        $.each(data, function(key, value) {
                            $('select[name="attribute_variants_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                        $('select[name="attribute_variants_id"]').niceSelect('update');
                    }
                });
            } else {
                $('select[name="attribute_variants_id"]').empty();
            }
        });
    });
</script>
<script type="text/javascript">
    $("#user_item_an_post").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
        },
        rules: {
            "item_picture1": {
                required: true,
            },
            "sku":{
                required: true,
            },
            "item_description": {
                required: true,
            },
            "describe_your_items": {
                required: true,
            },
            "category_id": {
                required: true,
            },
            "subcat_id": {
                required: true,
            },
            "brand_id": {
                required: true,
            },
            "condition_id": {
                required: true,
            },

            "enter_weight": {
                required: true,
            },
            "width": {
                required: true,
            },
            "length": {
                required: true,
            },
            "height": {
                required: true,
            },
            "qty_id": {
                required: true,
            },
            "ship_from": {
                required: true,
            },
            // "ship_mode_id": {
            //     required: true,
            // },
            "delivery_type": {
                required: true,
            },
            "pay_for_shipping": {
                required: true,
            },
            "price_type": {
                required: true,
            },
            "price": {
                required: true,
            },
        },
        messages: {

            "item_picture1": {
                required: '{{ __("frontend-messages.post_item.validation.item_picture1") }}',
            },
            "sku": {
                required: '{{ __("frontend-messages.post_item.validation.sku") }}',
            },
            "item_description": {
                required: '{{ __("frontend-messages.post_item.validation.item_description") }}',
            },
            "describe_your_items": {
                required: '{{ __("frontend-messages.post_item.validation.describe_your_items") }}',
            },
            "category_id": {
                required: '{{ __("frontend-messages.post_item.validation.please_select_category") }}',
            },
            "subcat_id": {
                required: '{{ __("frontend-messages.post_item.validation.please_select_sub_category") }}',
            },
            "brand_id": {
                required: '{{ __("frontend-messages.post_item.validation.please_select_brand") }}',
            },
            "condition_id": {
                required: '{{ __("frontend-messages.post_item.validation.please_select_condition") }}',
            },
            "enter_weight": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_weight") }}',
            },
            "width": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_width") }}',
            },
            "length": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_length") }}',
            },
            "height": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_height") }}',
            },
            "qty_id": {
                required: '{{ __("frontend-messages.post_item.validation.please_select_qty") }}',
            },
            "ship_from": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_input_zip_code") }}',
            },
            // "ship_mode_id": {
            //     required: '{{ __("frontend-messages.post_item.validation.please_select_ship_mode") }}',
            // },
            "delivery_type": {
                required: '{{__("frontend-messages.post_item.validation.please_select_delivery_type")}}',
            },
            "pay_for_shipping": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_pay_for_shipping") }}',
            },
            "price_type": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_price_type") }}',
            },
            "price": {
                required: '{{ __("frontend-messages.post_item.validation.please_enter_pricing") }}',
            },
        },
        submitHandler: function(form) {
            var $this = $('.loader_class');
            var loadingText =
                '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
            $('.loader_class').prop("disabled", true);
            $this.html(loadingText);
            form.submit();
        }
    });
</script>

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
 
    $(document).ready(function() {    
  
        $("#price").keyup(function(){
            var price = $("#price").val(); 
            var commision_data = $("#commision_data").val(); 
            var comissionPrice = ((price/100) * commision_data);
            var totalPrice = price - comissionPrice;
            $("#total_price").val(totalPrice);         
            $("#total_price_td").text(totalPrice);         
        });
       
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