@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Sell Item' }}
@endsection

@section('content')
<div class="post-an-item-wrapper">
    <h4>@lang('frontend-messages.post_item.post_an_item')</h4>
    <div class="post-an-item-form">
        <form action="{{ route('frontend.users.post-items.update') }}" enctype="multipart/form-data" method="post" id="user_item_edit_post" value="{{ $view_post->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $view_post->id }}">
            <div class="img-upload border-bottom">
                <label>@lang('frontend-messages.post_item.upload_item_picture')</label>
                <ul>
                    <li>
                        <div class="input-group file-upload">
                            <div class="file-upload-div">
                                <input type="file" onchange="readURL101(this);" name="item_picture1">
                                @if ($view_post_image->item_picture1 != '' &&
                                file_exists(public_path('assets/post/' . $view_post_image->item_picture1)))
                                <img id="blah101" src="{{ asset('assets/post/' . $view_post_image->item_picture1) }}" alt="Profile Picture" height="100" width="100" />
                                @else
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
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
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
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
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
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
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
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
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
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
                                <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                                @endif
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="description border-bottom">
                <label>@lang('frontend-messages.post_item.description')</label>
                <div class="input-group">
                    <input type="text" name="sku" value="{{ $view_post->sku }}" class="form-control">
                </div>
                <div class="input-group">
                    <input type="text" name="what_are_you_selling" value="{{ $view_post->what_are_you_selling }}" class="form-control">
                </div>
                <div class="input-group">
                    <textarea class="form-control" name="describe_your_items" value="{{ $view_post->describe_your_items }}">{{ $view_post->describe_your_items }}</textarea>
                </div>
            </div>
            <div class="details border-bottom">
                <label>@lang('frontend-messages.post_item.details')<span>*@lang('frontend-messages.post_item.fields_add_as_per_category')</span></label>
                <div class="input-group">
                    <select class="form-select" name="category_id" data-selected="{{ $view_post->category_id }}">
                        @foreach ($category as $cat)
                        <option value="{{ $cat->id }}" {{ $cat->id == $view_post->category_id ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                {{ $cat->category_name }}
                            @else
                                {{ $cat->ar_category_name }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="subcat_id" id="subcat_id" data-selected="{{ $view_post->sub_category_id }}">
                        @foreach ($sub_category as $subCate)
                        <option value="{{ $subCate->id }}" {{ $subCate->id == $view_post->sub_category_id ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                {{ $subCate->sub_cate_name }}
                            @else
                                {{ $subCate->ar_sub_cate_name }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <select class="form-select" name="brand_id" id="brand_id" data-selected="{{ $view_post->brand_id }}">
                        @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ $brand->id == $view_post->brand_id ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                {{ $brand->name }}
                            @else
                                {{ $brand->ar_name }}
                            @endif
                        </option>
                        @endforeach
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
                    <select class="form-select" name="condition_id" data-selected="{{ $view_post->condition_id }}">
                        @foreach ($condition as $con)
                        <option value="{{ $con->id }}" {{ $con->id == $view_post->condition_id ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                {{ $con->name }}
                            @else
                                {{ $con->ar_name }}
                            @endif
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group">
                    <input type="text" name="weight" class="form-control" value="{{ $view_post->weight }}" placeholder="@lang('frontend-messages.post_item.placeholder.enter_weight')">
                </div>
                <div class="input-group">
                    <input type="text" name="width" class="form-control" value="{{ $view_post->width }}" placeholder="@lang('frontend-messages.post_item.placeholder.width')">
                </div>
                <div class="input-group">
                    <input type="text" name="length" class="form-control" value="{{ $view_post->length }}" placeholder="@lang('frontend-messages.post_item.placeholder.length')">
                </div>
                <div class="input-group">
                    <input type="text" name="height" class="form-control" value="{{ $view_post->height }}" placeholder="@lang('frontend-messages.post_item.placeholder.height')">
                </div>
                <div class="input-group">
                    <input type="text" name="quantity" class="form-control" value="{{ $view_post->quantity }}" placeholder="@lang('frontend-messages.post_item.placeholder.quantity')">
                    <select class="form-select" name="stock_plus_or_minus" data-selected="{{ $view_post->stock_plus_or_minus }}">
                        <option value="plus">Plus</option>
                        <option value="minus">Minus</option>
                    </select>
                </div>
            </div>
            <div class="ship-from border-bottom">
                <label>@lang('frontend-messages.post_item.ship_from')</label>
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
            <div class="ship-mode border-bottom">
                <label>@lang('frontend-messages.post_item.delivery_type')</label>
                <div class="input-group">
                    <select class="form-select" name="delivery_type">
                        <option value="" selected disabled>@lang('frontend-messages.post_item.select_delivery_type')</option>
                        @if (!empty($delivery_type) && count($delivery_type) > 0)
                        @foreach ($delivery_type as $key => $value)
                        <option value="{{ $value->id }}" {{ $value->id == $view_post->delivery_type ? 'selected' : '' }}>
                            @if (App::isLocale('en'))
                                {{ $value->name }}
                            @else
                                {{ $value->ar_name }}
                            @endif
                        </option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('frontend-messages.post_item.who_do_you_want_to_pay_for_shipping')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="0" id="the-buyer" {{ $view_post->pay_shipping == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="the-buyer">@lang('frontend-messages.post_item.the_buyer')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="1" id="i-will-pay" {{ $view_post->pay_shipping == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="i-will-pay">@lang('frontend-messages.post_item.i_will_buy')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="pay_shipping" value="2" id="split" {{ $view_post->pay_shipping == '2' ? 'checked' : '' }}>
                    <label class="form-check-label" for="split">@lang('frontend-messages.post_item.split')</label>
                </div>
            </div>
            <div class="pay-for-shipping border-bottom">
                <label>@lang('frontend-messages.post_item.select_price_type')</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="0" id="fixed-price" {{ $view_post->price_type == '0' ? 'checked' : '' }}>
                    <label class="form-check-label" for="fixed-price">@lang('frontend-messages.post_item.fixed_price')</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="price_type" value="1" id="negotiable" {{ $view_post->price_type == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="negotiable">@lang('frontend-messages.post_item.negotiable')</label>
                </div>
            </div>
            <div class="pricing">
                <label>@lang('frontend-messages.post_item.pricing')</label>
                <div class="input-group">
                    <input type="text" name="price" value="{{ $view_post->price }}" class="form-control">
                </div>
                <table>
                    <tr>
                        <td>@lang('frontend-messages.post_item.commission_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('frontend-messages.post_item.shipping_charge')</td>
                        <td>-100 {{env('CURRENCY_TAG')}}</td>
                    </tr>
                    <tr>
                        <td>@lang('frontend-messages.post_item.total')</td>
                        <td>1000 {{env('CURRENCY_TAG')}}</td>
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

@section('script')
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
<!-- get subcategory by category -->
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="subcat_id"]').append('<option value="">Select Subcategory</option>');
        $('select[name="subcat_id"]').niceSelect('update');
        $('select[name="category_id"]').on('change', function() {
            var categoryID = $(this).val();
            if (categoryID) {
                $.ajax({
                    url: "{{ url('/post-items/subcat') }}/" + categoryID,
                    //url: "{{ url('/subcat') }}/" + categoryID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subcat_id"]').empty();
                        $('select[name="subcat_id"]').append(
                            '<option value="">Select Subcategory</option>');
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
        $('select[name="brand_id"]').append('<option value="">Select Brand</option>');
        $('select[name="brand_id"]').niceSelect('update');
        $('select[name="subcat_id"]').on('change', function() {
            var subCatID = $(this).val();
            if (subCatID) {
                $.ajax({
                    url: "{{ url('/post-items/brand') }}/" + subCatID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="brand_id"]').empty();
                        $('select[name="brand_id"]').append(
                            '<option value="">Select Brand</option>');
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