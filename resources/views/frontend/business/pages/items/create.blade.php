@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - Business - Item Post' }}
@endsection
@section('content')
<div class="post-an-item-wrapper">
    <h4>@lang('business_messages.post_an_item.post_an_item')</h4>
    <div class="post-an-item-form">
        <form action="{{ route('frontend.business.item-post.store') }}" enctype="multipart/form-data" method="post" id="b_item_an_post">
            @csrf
            <div class="img-upload border-bottom">
                <label>@lang('business_messages.post_an_item.upload_item_picture')</label>
                <ul>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' name="item_picture1" value="{{ old('item_picture1') }}" onchange="readURL1(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img1">
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
                                <input type='file' name="item_picture2" value="{{ old('item_picture2') }}" onchange="readURL2(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img2">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' name="item_picture3" value="{{ old('item_picture3') }}" onchange="readURL3(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img3">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' name="item_picture4" value="{{ old('item_picture4') }}" onchange="readURL4(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img4">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' name="item_picture5" value="{{ old('item_picture5') }}" onchange="readURL5(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img5">
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' name="item_picture6" value="{{ old('item_picture6') }}" onchange="readURL6(this);" />
                                <img src="assets/images/img/post-img- upload-photo1.png" id="post-item-img6">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="description border-bottom">
                <label>@lang('business_messages.post_an_item.description')</label>
                <div class="input-group">
                    <input type="text" placeholder="SKU" name="sku" value="{{ old('sku') }}" class="form-control">
                    @if ($errors->has('sku'))
                    <span class="text-danger">{{ $errors->first('sku') }}</span>
                    @endif
                </div>

                <div class="input-group">
                    <input type="text" name="item_description" value="{{ old('item_description') }}" placeholder="@lang('business_messages.post_an_item.placeholder.what_are_you_selling')" class="form-control">
                    @if ($errors->has('item_description'))
                    <span class="text-danger">{{ $errors->first('item_description') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="describe_your_items" value="{{ old('describe_your_items') }}" placeholder="@lang('business_messages.post_an_item.placeholder.describe_your_items')"></textarea>
                    @if ($errors->has('describe_your_items'))
                    <span class="text-danger">{{ $errors->first('describe_your_items') }}</span>
                    @endif
                </div>
            </div>
            <div class="details border-bottom">
                <label>@lang('business_messages.post_an_item.details') <span>@lang('business_messages.post_an_item.field_add_as_per_cate')</span></label>

                <div class="input-group">
                    <select class="form-control form-select category-h" name="category_id" id="dropDownSearch">
                        <option selected>@lang('business_messages.post_an_item.select_category')</option>
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
                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <select class="form-select" name="subcat_id" id="subcat_id">
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="brand_id" id="brand_id">
                    </select>
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
                        <option value="">@lang('business_messages.post_an_item.select_condition')</option>
                        @if (!empty($condition) && count($condition))
                        @foreach ($condition as $key => $value)
                        <option value="{{ $value->id }}">
                            @if (App::isLocale('en'))
                                <span>{{ $value->name }}</span>
                            @else
                                <span>{{ $value->ar_name }}</span>
                            @endif
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <label id="condition_id-error" class="error" for="condition_id"></label>
                    @if ($errors->has('condition_id'))
                    <span class="text-danger">{{ $errors->first('condition_id') }}</span>
                    @endif
                </div>
                <!-- <div class="input-group">
                    <select class="form-select" name="store_id">
                        <option value="">@lang('business_messages.post_an_item.select_store')</option>
                        @if (!empty($stores) && count($stores))
                        @foreach ($stores as $key => $value)
                        <option value="{{ $value->id }}">
                            @if (App::isLocale('en'))
                                <span>{{ $value->store_name }}</span>
                            @else
                                <span>{{ $value->ar_store_name }}</span>
                            @endif
                        </option>
                        @endforeach
                        @endif
                    </select>
                    <label id="store_id-error" class="error" for="store_id"></label>
                    @if ($errors->has('store_id'))
                    <span class="text-danger">{{ $errors->first('store_id') }}</span>
                    @endif
                </div> -->
                <div class="input-group">
                    <input type="text" name="enter_weight" value="{{ old('enter_weight') }}" placeholder="@lang('business_messages.post_an_item.placeholder.enter_weight')" class="form-control">
                    @if ($errors->has('enter_weight'))
                    <span class="text-danger">{{ $errors->first('enter_weight') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="width" value="{{ old('width') }}" placeholder="@lang('business_messages.post_an_item.placeholder.width')" class="form-control">
                    @if ($errors->has('width'))
                    <span class="text-danger">{{ $errors->first('width') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="length" value="{{ old('length') }}" placeholder="@lang('business_messages.post_an_item.placeholder.length')" class="form-control">
                    @if ($errors->has('length'))
                    <span class="text-danger">{{ $errors->first('length') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="height" value="{{ old('height') }}" placeholder="@lang('business_messages.post_an_item.placeholder.height')" class="form-control">
                    @if ($errors->has('height'))
                    <span class="text-danger">{{ $errors->first('height') }}</span>
                    @endif
                </div>
                <div class="input-group">
                    <input type="text" name="qty_id" value="{{ old('qty_id') }}" placeholder="Enter QTY" class="form-control">
                        @if ($errors->has('qty_id'))
                        <span class="text-danger">{{ $errors->first('qty_id') }}</span>
                        @endif
                </div>
            </div>
            <div class="ship-from border-bottom">
                <label>@lang('business_messages.post_an_item.ship_from')</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="searchfield" name="ship_from" placeholder="Address">
                    <input id="lat" type="hidden" name="lat">
                    <input id="lng" type="hidden" name="lng">
                    <label id="ship_from-error" class="error" for="ship_from"></label>
                    @if ($errors->has('ship_from'))
                    <span class="text-danger">{{ $errors->first('ship_from') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper-map">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="input-group">
                <select class="form-select" name="delivery_type">
                    <option value="" selected disabled>@lang('business_messages.post_an_item.select_delivery_type')</option>
                    @if (!empty($delivery_type) && count($delivery_type))
                    @foreach ($delivery_type as $key => $value)
                    <option value="{{ $value->id }}">
                        @if (App::isLocale('en'))
                        <span>{{ $value->name }}</span>
                        @else
                            <span>{{ $value->ar_name }}</span>
                        @endif   
                    </option>
                    @endforeach
                    @endif
                </select>
                <label id="delivery_type-error" class="error" for="delivery_type"></label>
                @if ($errors->has('delivery_type'))
                <span class="text-danger">{{ $errors->first('delivery_type') }}</span>
                @endif
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('business_messages.post_an_item.pay_for_shipping')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_for_shipping" id="the-buyer" value="0">
                    <label class="form-check-label" for="the-buyer">@lang('business_messages.post_an_item.the_buyer')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_for_shipping" id="i-will-pay" value="1" checked>
                    <label class="form-check-label" for="i-will-pay">@lang('business_messages.post_an_item.i-will-pay')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_for_shipping" id="split" value="2" checked>
                    <label class="form-check-label" for="split">@lang('business_messages.post_an_item.split')</label>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('business_messages.post_an_item.select_price_type')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="0" id="fixed-price" checked>
                    <label class="form-check-label" for="fixed-price">@lang('business_messages.post_an_item.fixed_price')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="1" id="negotiable" checked>
                    <label class="form-check-label" for="negotiable">@lang('business_messages.post_an_item.negotiable')</label>
                </div>
            </div>

            <div class="pricing">
                <label>@lang('business_messages.post_an_item.pricing')</label>
                <div class="input-group">
                    <input type="text" name="pricing" value="{{ old('pricing') }}" placeholder="1200 {{env('CURRENCY_TAG')}}" class="form-control" id="price">
                    @if ($errors->has('pricing'))
                    <span class="text-danger">{{ $errors->first('pricing') }}</span>
                    @endif
                </div>
                <table>
                    <tr>
                        <td>@lang('business_messages.post_an_item.commission_charge')</td>
                        <input type="hidden" id="commision_data" name="commission_charge"  value="{{$commission_user}}">
                        <td>-{{$commission_user}} {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <!-- <tr>
                        <td>@lang('business_messages.post_an_item.shipping_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr> -->
                    <tr>
                        <td>@lang('business_messages.post_an_item.total')</td>
                        <input type="hidden" id="total_price" name="total_amount"  >
                        <td id="total_price_td"> {{env('CURRENCY_TAG')}}</td>
                    </tr>
                </table>
            </div>
            <div class="submit-post">
                <div class="input-group">
                    <input type="submit" class="form-control btn" value="@lang('business_messages.post_an_item.post_your_item')">
                </div>
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
                            <a href="javascript:void(0)"><img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
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
<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
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