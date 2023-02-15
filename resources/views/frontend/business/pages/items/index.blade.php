@extends('frontend.business.includes.web')
@section('pageTitle')
{{ 'Tejarh - Business My Items' }}
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
                                <input class="form-check-input brandFilter1 userCateFilter" name="brands[]" data-brand="{{ $brand->name }}" type="checkbox" value="{{ $brand->id }}" id="brands{{ $key }}">

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
                                        <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}">
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
                                            <tr>
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
                                                @if(Auth::user()->role == STORE_ROLE)
                                                @if ($value['condition']['name'] == NEW_ITEMS)
                                                <td><a href="{{ route('frontend.store.new-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @elseif ($value['condition']['name'] == USED_ITEMS)
                                                <td><a href="{{ route('frontend.store.used-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @elseif ($value['condition']['name'] == UNUSED_ITEMS)
                                                <td><a href="{{ route('frontend.store.unused-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @endif
                                                @else
                                                @if ($value['condition']['name'] == NEW_ITEMS)
                                                <td><a href="{{ route('frontend.business.new-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @elseif ($value['condition']['name'] == USED_ITEMS)
                                                <td><a href="{{ route('frontend.business.used-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @elseif ($value['condition']['name'] == UNUSED_ITEMS)
                                                <td><a href="{{ route('frontend.business.unused-items.myproduct_details', ($value['id'])) }}"><i class="fas fa-eye"></i></a></td>
                                                @endif
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
<!-- upload Images -->
<div class="modal fade" id="uploadimagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Bulk Images</h5>
            <form action="{{route('frontend.business.pages.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="sample-pro-store">
                    <div class="input-group file-upload-icon">
                        <input type="file" name="imageFile[]" placeholder="Upload CR" class="form-control" id="images" multiple="multiple">
                        <h5>Choose File</h5>
                    </div>
                    <div class="form-group submit">
                        <input type="submit" class="btn btn-primary" value="Upload">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- BulkproductModal -->
<div class="modal fade" id="bulkproductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <h5>Bulk Product</h5>
            <div class="form-check redio-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="samplecsv" checked>
                <label class="form-check-label" for="samplecsv">
                    Sample CSV Download
                </label>
            </div>
            <div class="form-check redio-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="bulkproductcsv">
                <label class="form-check-label" for="bulkproductcsv">
                    Bulk Product CSV Upload
                </label>
            </div>
            @if (!empty($stores) && count($stores) > 0)
            <div class="sample-pro-store store-commman activeTab" id="scsv">
                <h5>Store</h5>
                <div class="input-group">
                    <select class="form-select select_stores" name="select_stores" id="select_stores" aria-label="Default select example">
                        <option selected>Choose Store</option>
                        @foreach($stores as $v)
                        <option value="{{$v['id']}}">{{$v['store_name']}}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group submit">

                    <a class="btn btn-primary import_product" href="{{route('frontend.business.my-items.exportitems',$v['id'])}}" style="color: black;"> <i class='fas fa-file-export'></i> Export Excel File </a>
                    <!-- <input type="submit" class="btn btn-primary import_product" value="Download"> -->
                </div>
                <p>Click in on download will download a sample CSV product file.</p>
            </div>
            @else
            <div class="sample-pro-store store-commman activeTab" id="scsv">
                <h5>Store</h5>
                <div class="input-group">
                    <p>Store Not Available..</p>
                </div>
            </div>
            @endif
            <div class="bulk-pro-store store-commman" id="bcsv">
                <form action="{{route('frontend.business.pages.importproduct.import_parse')}}" method="POST" enctype="multipart/form-data" id="import_products">
                    @csrf
                    <div class="input-group file-upload-icon">
                        <input type="file" name="csv_file" placeholder="Upload CR" class="form-control">
                        <h5>Choose File</h5>
                    </div>
                    <input id="header" class="ml-1" type="checkbox" name="header" checked />
                    <div class="form-group submit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                </form>
                <div class="sign-in-with"></div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('fronted/business_flow/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/checkout_assets/app.js') }}"></script>
<link rel="stylesheet" href="{{ asset('fronted/business_flow/assets/css/category_filter.css') }}">
<script src="{{ asset('fronted/business_flow/assets/js/form-validator.min.js') }}"></script>
<script src="{{ asset('fronted/business_flow/assets/js/validation_js/jquery.validate.min.js') }}"></script>

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
    #pagingBox tbody {
        width: 100%;
    }

    #pagingBox tbody td,
    #pagingBox thead td {
        text-align: center;
    }

    #pagingBox thead {
        display: table !important;
        width: 100%;
    }

    table #pagingBox td,
    table #pagingBox th {
        padding: 10px 8px;
        text-align: center;
    }

    #pagingBox tbody td:first-child,
    #pagingBox thead th:first-child {
        width: 7%;
        text-align: center;
    }

    #pagingBox tbody td:last-child,
    #pagingBox thead th:last-child {
        width: 9%;
        text-align: center;
    }

    #pagingBox tbody td.img,
    #pagingBox thead th.img {
        width: 17%;
        text-align: center;
    }

    #pagingBox tbody td.name,
    #pagingBox thead th.name {
        width: 18%;
        text-align: center;
    }

    #pagingBox tbody td.price,
    #pagingBox thead th.price {
        width: 9%;
        text-align: center;
    }

    #pagingBox tbody td.condi,
    #pagingBox thead th.condi {
        width: 11%;
        text-align: center;
    }

    #pagingBox tbody td.city,
    #pagingBox thead th.city {
        width: 20%;
        text-align: center;
    }

    #pagingBox tbody td.qty,
    #pagingBox thead th.qty {
        width: 9%;
        text-align: center;
    }
</style>
@endsection