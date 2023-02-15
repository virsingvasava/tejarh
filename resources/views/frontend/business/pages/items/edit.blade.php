@extends('frontend.business.includes.web')

@section('pageTitle')
{{ 'Tejarh - Business - Item Post' }}
@endsection

@section('content')
<div class="post-an-item-wrapper">
    <h4>@lang('business_messages.post_an_item.post_an_item')</h4>
    <div class="post-an-item-form">
        <form action="{{ route('frontend.business.item-post.update') }}" enctype="multipart/form-data" method="post" id="user_item_edit_post" value="{{ $view_post->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $view_post->id }}">
            <div class="img-upload border-bottom">
                <label>@lang('business_messages.post_an_item.upload_item_picture').</label>
                <ul>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <!-- <input type='file' onchange="readURL101(this);" name="item_picture1" />
                                    @if ($view_post_image->item_picture1 != '' &&
                                        file_exists(public_path('assets/post/' . $view_post_image->item_picture1)))
                                        <img src="{{ asset('assets/post/' . $view_post_image->item_picture1) }}" alt="Profile Picture" height="100" width="100" id="post-item-img101" />
                                    @else
                                        <img src="{{ asset('assets/images/post-img- upload-photo1.png') }}" id="post-item-img101">
                                    @endif -->

                                <input type="file" onchange="readURL101(this);" name="item_picture1">
                                @if ($view_post_image->item_picture1 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture1)))
                                <img id="blah101" src="{{ asset('assets/post/' . $view_post_image->item_picture1) }}" alt="Profile Picture" height="100" width="100" />
                                @else
                                <img id="blah101" src="{{ asset('assets/images/post-img- upload-photo1.png') }}">
                                @endif

                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL2(this);" name="item_picture2" />
                                @if ($view_post_image->item_picture2 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture2)))
                                <img id="image_preview" src="{{ asset('assets/post/' . $view_post_image->item_picture2) }}" alt="Profile Picture" height="100" width="100" id="post-item-img1" />
                                @else
                                <img src="{{ asset('assets/images/post-img- upload-photo2.png') }}" id="post-item-img2">
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL3(this);" name="item_picture3" />
                                @if ($view_post_image->item_picture3 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture3)))
                                <img id="image_preview" src="{{ asset('assets/post/' . $view_post_image->item_picture3) }}" alt="Profile Picture" height="100" width="100" id="post-item-img1" />
                                @else
                                <img src="{{ asset('assets/images/post-img- upload-photo3.png') }}" id="post-item-img3">
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL4(this);" name="item_picture4" />
                                @if ($view_post_image->item_picture4 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture4)))
                                <img id="image_preview" src="{{ asset('assets/post/' . $view_post_image->item_picture4) }}" alt="Profile Picture" height="100" width="100" id="post-item-img1" />
                                @else
                                <img src="{{ asset('assets/images/post-img- upload-photo4.png') }}" id="post-item-img4">
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL5(this);" name="item_picture5" />
                                @if ($view_post_image->item_picture5 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture5)))
                                <img id="image_preview" src="{{ asset('assets/post/' . $view_post_image->item_picture5) }}" alt="Profile Picture" height="100" width="100" id="post-item-img1" />
                                @else
                                <img src="{{ asset('assets/images/post-img- upload-photo5.png') }}" id="post-item-img5">
                                @endif
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type='file' onchange="readURL6(this);" name="item_picture6" />
                                @if ($view_post_image->item_picture6 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture6)))
                                <img id="image_preview" src="{{ asset('assets/post/' . $view_post_image->item_picture6) }}" alt="Profile Picture" height="100" width="100" id="post-item-img1" />
                                @else
                                <img src="{{ asset('assets/images/post-img- upload-photo6.png') }}" id="post-item-img6">
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="description border-bottom">
                <label>@lang('business_messages.post_an_item.description')</label>
                <div class="input-group">
                    <input type="text" name="what_are_you_selling" value="{{ $view_post->sku}}" class="form-control">
                </div>
                <div class="input-group">
                    <input type="text" name="what_are_you_selling" value="{{ $view_post->what_are_you_selling }}" class="form-control">
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="describe_your_items" value="{{ $view_post->describe_your_items }}">{{ $view_post->describe_your_items }}</textarea>
                </div>
            </div>
            <div class="details border-bottom">
                <label>@lang('business_messages.post_an_item.details')<span>@lang('business_messages.post_an_item.field_add_as_per_cate')</span></label>
                <div class="input-group">
                    <select class="form-select" name="category_id" data-selected="{{ $view_post->category_id }}">
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $view_post->category_id ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                <span>{{ $cat->category_name }}</span>
                            @else
                                <span>{{ $cat->ar_category_name }}</span>
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="subcat_id" id="subcat_id" data-selected="{{ $view_post->sub_category_id }}">
                        @foreach ($sub_category as $subCate)
                        <option value="{{ $subCate->id }}" {{ $subCate->id == $view_post->sub_category_id ? 'selected' : '' }}>
                            {{ $subCate->sub_cate_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="brand_id" id="brand_id" data-selected="{{ $view_post->brand_id }}">
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $view_post->brand_id ? 'selected' : '' }}>{{ $brand->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="attribute_id" id="attribute_id">
                    <option value="">Select Attribute</option>
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="attribute_variants_id" id="attribute_variants_id">
                    <option value="">Select Attribute</option>
                    </select>
                </div>

                <div class="input-group">
                    <select class="form-select" name="condition_id" data-selected="{{ $view_post->condition_id }}">
                        @foreach ($condition as $con)
                        <option value="{{ $con->id }}" {{ $con->id == $view_post->condition_id ? 'selected' : '' }}>{{ $con->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="store_id">
                        <option value="">@lang('business_messages.post_an_item.select_store')</option>
                        @if (!empty($stores) && count($stores))
                        @foreach ($stores as $key => $value)
                        <option value="{{ $value->id }}" {{ $value->id == $view_post->store_id ? 'selected' : '' }}>
                            {{ $value->store_name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
                <div class="input-group">
                    <input type="text" name="weight" class="form-control" value="{{ $view_post->weight }}" placeholder="@lang('business_messages.post_an_item.placeholder.enter_weight')">
                </div>
                <div class="input-group">
                    <input type="text" name="width" class="form-control" value="{{ $view_post->width }}" placeholder="@lang('business_messages.post_an_item.placeholder.width')">
                </div>
                <div class="input-group">
                    <input type="text" name="length" class="form-control" value="{{ $view_post->length }}" placeholder="@lang('business_messages.post_an_item.placeholder.length')">
                </div>
                <div class="input-group">
                    <input type="text" name="height" class="form-control" value="{{ $view_post->height }}" placeholder="@lang('business_messages.post_an_item.placeholder.height')">
                </div>
                <div class="input-group">
                <input type="text" name="quantity" class="form-control" value="{{ $view_post->quantity }}" placeholder="Enter QTY">
                <select class="form-select" name="stock_plus_or_minus" data-selected="{{ $view_post->stock_plus_or_minus }}">
                    <option value="plus">Plus</option>
                    <option value="minus">Minus</option>
                </select>
                </div>
            </div>
            <div class="ship-from border-bottom">
                <label>@lang('business_messages.post_an_item.ship_from')</label>
                <div class="input-group">
                    <input type="text" name="address" id="searchfield" value="{{ $view_post->address }}" class="form-control">
                    <input id="lat" type="hidden" name="lat" value="{{ $view_post->latitude }}">
                    <input id="lng" type="hidden" name="lng" value="{{ $view_post->longitude }}">
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="wrapper-map">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="ship-mode border-bottom">
                    <label>@lang('business_messages.post_an_item.ship_mode')</label>
                    <div class="input-group">
                        <select class="form-select" name="ship_mode_id">
                            <option value="">Select Ship Mode</option>
                            @if (!empty($ship_mode) && count($ship_mode) > 0)
                                @foreach ($ship_mode as $key => $value)
                                    <option value="{{ $value->id }}"
                                        {{ $value->id == $view_post->ship_mode_id ? 'selected' : '' }}>
                                        {{ $value->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> -->
            <div class="ship-mode border-bottom">
                <label>@lang('business_messages.post_an_item.delivery_type')</label>
                <div class="input-group">
                    <select class="form-select" name="delivery_type">
                        <option value="" selected disabled>@lang('business_messages.post_an_item.select_delivery_type')</option>
                        @if (!empty($delivery_type) && count($delivery_type) > 0)
                        @foreach ($delivery_type as $key => $value)
                        <option value="{{ $value->id }}" {{ $value->id == $view_post->delivery_type ? 'selected' : '' }}>
                            {{ $value->name }}
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('business_messages.post_an_item.pay_for_shipping')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="0" id="the-buyer" {{ $view_post->pay_shipping == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="the-buyer">@lang('business_messages.post_an_item.the_buyer')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="1" id="i-will-pay" {{ $view_post->pay_shipping == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="i-will-pay">@lang('business_messages.post_an_item.i-will-pay')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="2" id="split" {{ $view_post->pay_shipping == '2' ? 'checked' : '' }}>
                    <label class="form-check-label" for="split">@lang('business_messages.post_an_item.split')</label>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('business_messages.post_an_item.select_price_type')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="0" id="fixed-price" {{ $view_post->price_type == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="fixed-price">@lang('business_messages.post_an_item.fixed_price') </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="1" id="negotiable" {{ $view_post->price_type == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="negotiable">@lang('business_messages.post_an_item.negotiable')</label>
                </div>
            </div>
            <div class="pricing">
                <label>@lang('business_messages.post_an_item.pricing')</label>
                <div class="input-group">
                    <input type="text" name="price" value="{{ $view_post->price }}" class="form-control">
                </div>
                <table>
                    <tr>
                        <td>@lang('business_messages.post_an_item.commission_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('business_messages.post_an_item.shipping_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('business_messages.post_an_item.total')</td>
                        <td>1000 {{env('CURRENCY_TAG')}}</td>
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

<script type="text/javascript">
    $("#user_item_an_post").validate({
        ignore: "not:hidden",
        onfocusout: function(element) {
            this.element(element);
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
<script type="text/javascript">
    $(document).on('change', '.image', function() {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
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