@extends('frontend.users.layouts.master')

@section('title')
{{ 'Tejarh - Product Category' }}
@endsection

@section('content')
@php

$condition = request()->query('condition');
$conditionArr = explode(',', $condition);

$price = request()->query('price');
$priceArr = explode(',', $price);

$brand = request()->query('brand');
$brandsArr = explode(',', $brand);

$cities = request()->query('city');
$citiesArr = explode(',', $cities);

$ratingsArr = request()->query('ratings');

@endphp
<div class="product-list">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="product-sidebar">
                    <div class="categories-wrapper">
                        <h5 class="line">@lang('frontend-messages.categories.categories')</h5>
                        <h6>@lang('frontend-messages.categories.all_categories')</h6>
                        <div id="treeview_container" class="hummingbird-treeview">
                            <input class="form-check-input userCateFilter" type="hidden" name="userId[]" data-categoryId="{{ $userId}}" value="{{ $userId}}">
                            <ul id="treeview" class="hummingbird-base show-more-height">
                                @foreach($categories as $key=> $cat)
                                <li data-id="0">
                                    <i class="fa fa-plus"></i><label>
                                        <input class="form-check-input userCateFilter" id="xnode-0" name="categories[]" data-categoryId="{{ $cat['id'] }}" value="{{ $cat['id'] }}" type="checkbox" />{{$cat['category_name']}}
                                    </label>
                                    @foreach($cat['my_subcategory'] as $key=> $sub_value)
                                    <ul>
                                        <li data-id="1">
                                            <label> <input class="hummingbird-end-node userCateFilter" name="subCates[]" data-categoryId="{{ $sub_value['category_id']}}" value="{{ $sub_value['id'] }}" id="xnode-0-1" type="checkbox" />{{$sub_value['sub_cate_name']}}</label>
                                        </li>
                                    </ul>
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>
                            <a class="cate-read-more">Show More</a>
                        </div>

                    </div>
                    
                    <div class="condition-wrapper m-30">
                        <h5 class="line">@lang('frontend-messages.categories.condition')</h5>
                        @foreach ($conditions as $key => $can)
                        <form class="condition_filter" enctype="multipart/form-data">
                            <div class="form-check">
                                <input class="form-check-input userCateFilter" name="condition[]" data-condition="{{ $can->name }}" type="checkbox" value="{{ $can->id }}" id="condition_{{ $key }}">
                                <label class="form-check-label" for="condition_{{ $key }}">
                                    {{ $can->name }}
                                </label>
                            </div>
                        </form>
                        @endforeach
                    </div>

                    <div class="brands-wrapper m-30">
                        <h5 class="line">@lang('frontend-messages.categories.brands')</h5>
                        <form class="brand_filter" enctype="multipart/form-data">
                            @foreach ($brands as $key => $brand)
                            <div class="form-check">
                                <input class="form-check-input brandFilter1 userCateFilter" name="brands[]" data-brand="{{ $brand->name }}" type="checkbox" value="{{ $brand->id }}" id="brands{{ $key }}" {{ in_array($brand->id, $brandsArr) ? 'checked' : '' }}>

                                <label class="form-check-label" for="brands{{ $key }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                        </form>
                    </div>

                    <div class="stocks-wrapper m-30">
                        <h5 class="line">@lang('frontend-messages.categories.stocks')</h5>
                        <form class="brand_filter" enctype="multipart/form-data">

                            <div class="form-check">
                                <input class="form-check-input brandFilter1 userCateFilter" name="less[]" type="checkbox" id="less{{$key}}">

                                <label class="form-check-label" for="less{{ $key }}">less then 10</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input brandFilter1 userCateFilter" name="outoffstock[]" type="checkbox" id="outoffstock{{$key}}">

                                <label class="form-check-label" for="outoffstock{{ $key }}">Out of Stock</label>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="col-md-9">
                <div class="products-wrapper">
                    <div class="container">
                        <div class="row mb-4">
                            <div class="col-md-7">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.users.site.index') }}">
                                                <i class="fas fa-home"></i> @lang('frontend-messages.header2.home')</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">My Product</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="col-md-5">
                                <ul class="import-btn text-r">
                                    <li><a href="javascript:void(0)" id="bulkproduct" class="btnf" data-bs-toggle="modal" data-bs-target="#bulkproductModal">Import Product</a></li>
                                    <li><a href="javascript:void(0)" id="bulkproductf" class="btnf" data-bs-toggle="modal" data-bs-target="#uploadimagesModal">Upload Images</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="pagination-hidden-section">
                                <input type='hidden' id='current_page' />
                                <input type='hidden' id='show_per_page' />
                            </div>
                        </div>
                        <div class="products-wrapper" id="sortingData">
                            <div class="row">
                                <div class="wishlist-table">
                                        <table id="pagingBox">
                                            <thead>
                                            <tr>
                                            <th>Sr.No</th>
                                            <th class="img">Image</th>
                                            <th class="name">Name</th>
                                            <th class="price">Price</th>
                                            <th class="condi">condition</th>
                                            <th class="city">City</th>
                                            <th class="qty">Quantity</th>
                                            <th>Action</th>
                                            </tr>

                                            </thead>
                                            @if (!empty($itemArray) && count($itemArray) > 0)
                                            <?php $i = 1; ?>
                                            @foreach ($itemArray as $key => $value)
                                            <tbody>
                                            <tr >
                                            <td>{{$i}}</td>
                                            @if ($value['item_pictures']['item_picture1'] != "" && file_exists(public_path('assets/post/'.$value['item_pictures']['item_picture1'])))
                                            <td class="img"><img width="60px" height="60px" src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_pictures']['item_picture1']) }}"></td>
                                            @else
                                            <td class="img"><img width="60px" height="60px" src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}"></td>
                                            @endif
                                            <td class="name">{{ $value['brand']['name'] }}</td>
                                            <td class="price">{{ $value['price'] }} {{env('CURRENCY_TAG')}}</td>
                                            @if ($value['condition']['name'] == NEW_ITEMS)
                                            <td class="condi"><span class="used-btn new-btn">{{ $value['condition']['name'] }}</span></td>
                                            @elseif ($value['condition']['name'] == USED_ITEMS)
                                            <td class="condi"><span class="used-btn used-btn">{{ $value['condition']['name'] }}</span></td>
                                            @elseif ($value['condition']['name'] == UNUSED_ITEMS)
                                            <td class="condi"><span class="used-btn unused-btn">{{ $value['condition']['name'] }}</span></td>
                                            @endif
                                            @if (!empty($value['store']['store_name']))
                                            <td class="city">{{ $value['store']['store_location'] }}</td>
                                            @else
                                            <td class="city">{{ $value['city']['name'] }}</td>
                                            @endif
                                            <td class="qty">{{ $value['inventory']['stock_remaining'] }}</td>
                                            @if ($value['condition']['name'] == NEW_ITEMS)
                                            <td><a href="{{ route('frontend.users.new-items.product_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                            @elseif ($value['condition']['name'] == USED_ITEMS)
                                            <td><a href="{{ route('frontend.users.used-items.product_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                            @elseif ($value['condition']['name'] == UNUSED_ITEMS)
                                            <td><a href="{{ route('frontend.users.unused-items.product_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                            @endif
                                            </tr>
                                            </tbody>
                                            <?php $i++; ?>
                                            @endforeach
                                            @endif
                                        </table>
                                        
                                </div>
                            </div>
                        </div>
                        @if (!empty($itemArray) && count($itemArray) > 19)
                        <div class="pagination-wrapper">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination" id='page_navigation'></ul>
                            </nav>
                        </div>
                        @endif
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
                <img src="{{ asset('assets/images/try-tejarg-app.png') }}">
            </div>
            <div class="col-md-7">
                <div class="mo-application">
                    <h2>@lang('frontend-messages.header.try_the_tejrah_app')</h2>
                    <p>@lang('frontend-messages.header.try_the_tejrah_app_sub_text')</p>
                    <ul>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/google-play.png') }}"> </a>
                        </li>
                        <li>
                            <a href="#"><img src="{{ asset('assets/images/app-store.png') }}"> </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('script')

<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>
<script>
    const rangeInput = document.querySelectorAll(".range-input input"),
        priceInput = document.querySelectorAll(".price-input input"),
        range = document.querySelector(".slider .progress");
    let priceGap = 1000;

    priceInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minPrice = parseInt(priceInput[0].value),
                maxPrice = parseInt(priceInput[1].value);
            if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                if (e.target.className === "input-min") {
                    rangeInput[0].value = minPrice;
                    range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                } else {
                    rangeInput[1].value = maxPrice;
                    range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                }
            }
        });
    });

    rangeInput.forEach((input) => {
        input.addEventListener("input", (e) => {
            let minVal = parseInt(rangeInput[0].value),
                maxVal = parseInt(rangeInput[1].value);

            if (maxVal - minVal < priceGap) {
                if (e.target.className === "range-min") {
                    rangeInput[0].value = maxVal - priceGap;
                } else {
                    rangeInput[1].value = minVal + priceGap;
                }
            } else {
                priceInput[0].value = minVal;
                priceInput[1].value = maxVal;
                range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
            }
        });
    });
</script>
<link rel="stylesheet" href="{{asset('fronted/users_flow/assets/css/hummingbird-treeview.css')}}">
<script src="{{ asset('fronted/users_flow/assets/js/hummingbird-treeview.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.userCateFilter').click(function() {
            let userIds = $('.userCateFilter').attr("data-categoryid");

            var categorieIds = [];
            $('input:checkbox[name="categories[]"]').each(function() {
                if (this.checked) {
                    categorieIds.push(this.value);
                }
            });

            var subCateIds = [];
            $('input:checkbox[name="subCates[]"]').each(function() {
                if (this.checked) {
                    subCateIds.push(this.value);
                }
            });

            var conditions = [];
            $('input:checkbox[name="condition[]"]').each(function() {
                if (this.checked) {
                    conditions.push(this.value);
                }
            });

            var brands = [];
            $('input:checkbox[name="brands[]"]').each(function() {
                if (this.checked) {
                    brands.push(this.value);
                }
            });

            var less = [];
            $('input:checkbox[name="less[]"]').each(function() {
                if (this.checked) {
                    less.push(this.value);
                }
            });

            var outoffstock = [];
            $('input:checkbox[name="outoffstock[]"]').each(function() {
                if (this.checked) {
                    outoffstock.push(this.value);
                }
            });

            var cities = [];
            $('input:checkbox[name="city[]"]').each(function() {
                if (this.checked) {
                    cities.push(this.value);
                }
            });

            var sellerRatings = [];
            $('input:checkbox[name="attr_value"]').each(function() {
                if (this.checked) {
                    sellerRatings.push(this.value);
                }
            });


            var sorting_data = $('.cateFilterPrice').find(":selected").val();
            var token = "{{ csrf_token() }}";

            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('frontend.users.my-items.userSubCateFilter') }}",
                data: {
                    'userIds': userIds,
                    'categorieIds': categorieIds,
                    'subCateIds': subCateIds,
                    'conditions': conditions,
                    'brands': brands,
                    'less': less,
                    'outoffstock': outoffstock,
                    'sorting_data': sorting_data,
                    _token: token
                },
                success: function(data) {
                    if (data) {
                        $('#sortingData').html(data);
                    } else {
                        location.reload();
                    }
                },
                timeout: 10000
            });
        });

        $(".userCateFilterPrice").on("change", function() {

            var sorting_data = $('.userCateFilterPrice').find(":selected").val();
            var cateIds = $("input[name='cateIds']").val();

            var subCateIds = [];
            $('input:checkbox[name="subCates[]"]').each(function() {
                if (this.checked) {
                    subCateIds.push(this.value);
                }
            });

            var conditions = [];
            $('input:checkbox[name="condition[]"]').each(function() {
                if (this.checked) {
                    conditions.push(this.value);
                }
            });

            var brands = [];
            $('input:checkbox[name="brands[]"]').each(function() {
                if (this.checked) {
                    brands.push(this.value);
                }
            });

            var cities = [];
            $('input:checkbox[name="city[]"]').each(function() {
                if (this.checked) {
                    cities.push(this.value);
                }
            });

            var sellerRatings = [];
            $('input:checkbox[name="attr_value"]').each(function() {
                if (this.checked) {
                    sellerRatings.push(this.value);
                }
            });

            let minPrice = parseInt(rangeInput[0].value),
                maxPrice = parseInt(rangeInput[1].value);

            var token = "{{ csrf_token() }}";
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "{{ route('frontend.users.product_category.userSubCateFilter') }}",
                data: {
                    'sorting_data': sorting_data,
                    'cateIds': cateIds,
                    'subCateIds': subCateIds,
                    'conditions': conditions,
                    'minPrice': minPrice,
                    'maxPrice': maxPrice,
                    'brands': brands,
                    'cities': cities,
                    'seller_ratings': sellerRatings,
                    _token: token
                },
                success: function(data) {
                    if (data) {
                        $('#sortingData').html(data);

                    } else {
                        location.reload();
                    }
                },
                timeout: 10000
            });
        });
    });
</script>
<script>
    $("#treeview").hummingbird();
    $("#checkAll").click(function() {
        $("#treeview").hummingbird("checkAll");
    });
    $("#uncheckAll").click(function() {
        $("#treeview").hummingbird("uncheckAll");
    });
    $("#collapseAll").click(function() {
        $("#treeview").hummingbird("collapseAll");
    });
    // $( "#checkNode" ).click(function() {
    //   $("#treeview").hummingbird("checkNode",{attr:"id",name: "node-0-2-2",expandParents:false});
    // });
</script>
<script>
    jQuery(".cate-read-more").click(function() {
        if (jQuery(".hummingbird-base").hasClass("show-more-height")) {
            jQuery(this).text("Show Less");
        } else {
            jQuery(this).text("Show More");
        }
        jQuery(".hummingbird-base").toggleClass("show-more-height");
    });
</script>
<script>
    $(document).ready(function() {

        var show_per_page = 20;
        var number_of_items = $('#pagingBox').children().length;
        var number_of_pages = Math.ceil(number_of_items / show_per_page);
        $('#current_page').val(0);
        $('#show_per_page').val(show_per_page);
        var navigation_html =
            '<li class="page-item"><a class="previous_link page-link" href="javascript:previous();"><</a></li>';
        var current_link = 0;
        while (number_of_pages > current_link) {
            navigation_html += '<a class="page_link page-link" href="javascript:go_to_page(' + current_link +
                ')" longdesc="' + current_link + '">' + (current_link + 1) + '</a>';
            current_link++;
        }
        navigation_html +=
            '<li class="page-item"><a class="next_link page-link" href="javascript:next();">></a></li>';
        $('#page_navigation').html(navigation_html);
        $('#page_navigation .page_link:first').addClass('active_page');
        $('#pagingBox').children().css('display', 'none');
        $('#pagingBox').children().slice(0, show_per_page).css('display', 'table');
    });

    function previous() {
        new_page = parseInt($('#current_page').val()) - 1;
        if ($('.active_page').prev('.page_link').length == true) {
            go_to_page(new_page);
        }
    }

    function next() {
        new_page = parseInt($('#current_page').val()) + 1;
        if ($('.active_page').next('.page_link').length == true) {
            go_to_page(new_page);
        }
    }

    function go_to_page(page_num) {
        var show_per_page = parseInt($('#show_per_page').val());
        start_from = page_num * show_per_page;
        end_on = start_from + show_per_page;
        $('#pagingBox').children().css('display', 'none').slice(start_from, end_on).css('display', 'table');
        $('.page_link[longdesc=' + page_num + ']').addClass('active_page').siblings('.active_page').removeClass(
            'active_page');
        $('#current_page').val(page_num);
    }
</script>
<style>
    #pagingBox tbody{width: 100%;}
    #pagingBox tbody td, #pagingBox thead td{text-align: center;}
    #pagingBox thead{display: table!important;width: 100%;}
    table #pagingBox td, table #pagingBox  th {padding: 10px 8px;text-align: center;}
    #pagingBox tbody td:first-child, #pagingBox thead th:first-child{width:7%;text-align: center;}
    #pagingBox tbody td:last-child, #pagingBox thead th:last-child{width:9%;text-align: center;}
    #pagingBox tbody td.img, #pagingBox thead th.img{width:17%;text-align: center;}
    #pagingBox tbody td.name, #pagingBox thead th.name{width:18%;text-align: center;}
    #pagingBox tbody td.price, #pagingBox thead th.price{width:9%;text-align: center;}
    #pagingBox tbody td.condi, #pagingBox thead th.condi{width:11%;text-align: center;}
    #pagingBox tbody td.city, #pagingBox thead th.city{width:20%;text-align: center;}
    #pagingBox tbody td.qty, #pagingBox thead th.qty{width:9%;text-align: center;}
 

</style>
@endsection