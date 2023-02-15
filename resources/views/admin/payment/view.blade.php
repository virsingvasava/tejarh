@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="breadcrumbs-top">
                    <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.history.order_history_details')</h5>
                    <div class="breadcrumb-wrapper d-none d-sm-block">
                        <ol class="breadcrumb p-0 mb-0 pl-1">
                            <li class="breadcrumb-item"><a href="{{route('admin.payment.index')}}"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.history.payment_history')
                            </li>
                            <li class="breadcrumb-item active">@lang('messages.common.view_details')
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Zero configuration table -->
            <section id="menu_view">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('messages.history.detail')</h4>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration or-view">
                                        <tbody>
                                            <tr>
                                                <th>@lang('messages.history.order_by')</th>
                                                <td>{{ $view_ckeckout_user->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.history.order_on')</th>
                                                <td>{{ \Carbon\Carbon::parse($view_ckeckout->created_at)->format('d/m/Y H:i:s A')}}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.history.product_created_by')</th>
                                                <td>{{ $view_user->first_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>@lang('messages.history.product_created_by')</th>
                                                <td>{{ \Carbon\Carbon::parse($view_products->created_at)->format('d/m/Y H:i:s A')}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('messages.history.product_details')</h4>
                            </div>
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>@lang('messages.product.view.product_name')</th>
                                                <th>@lang('messages.product.view.product_description')</th>
                                                <th>@lang('messages.product.price')</th>
                                                <th>@lang('messages.product.view.category')</th>
                                                <th>@lang('messages.product.view.sub_category')</th>
                                                <th>@lang('messages.product.view.brand') </th>
                                                <th>@lang('messages.product.view.condition')</th>
                                                <th>@lang('messages.product.view.quantity')</th>
                                                <th>@lang('messages.product.create.ship_form')</th>
                                                <th>@lang('messages.product.create.ship_mode')</th>
                                                <th>@lang('messages.product.view.pay_shipping')</th>
                                                <th>@lang('messages.product.view.price_type')</th>
                                                <th>@lang('messages.product.view.weight')</th>
                                            </tr>
                                        </thead>
                                        <tr>
                                            <td>{{ucfirst($view_products->what_are_you_selling)}}</td>
                                            <td>{{ucfirst($view_products->describe_your_items)}}</td>
                                            <td>{{$view_products->price}}</td>
                                            <td>{{ucfirst($view_category->category_name)}}</td>
                                            <td>{{ucfirst($view_sub_category->sub_cate_name)}}</td>
                                            <td>{{$view_brand->name}}</td>
                                            <td>{{$view_condition->name}}</td>
                                            <td>{{$view_products->quantity}}</td>
                                            <td>{{$view_products->zip_code}}</td>
                                            <td>{{$view_ship_mode->name}}</td>
                                            @if ($view_products->pay_shipping == '0')
                                            <td>The buyer</td>
                                            @elseif($view_products->pay_shipping == '1')
                                            <td>I will pay</td>
                                            @else
                                            <td>Split</td>
                                            @endif
                                            @if ($view_products->price_type == '0')
                                            <td>Fixed Price</td>
                                            @else
                                            <td>Negotiable</td>
                                            @endif
                                            <td>{{ucfirst($view_products->weight)}}</td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">@lang('messages.history.product_images')</h4>
                            </div>
                            <div class="card-body card-dashboard">
                                @foreach($view_products->itemImage as $key => $value)
                                <div id="product-slider2" class="product-gallary">
                                    @if (isset($value['item_picture1']) && !empty($value['item_picture1']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture1']) }}" height="80px">
                                    @endif

                                    @if (isset($value['item_picture2']) && !empty($value['item_picture2']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture2']) }}" height="80px">
                                    @endif

                                    @if (isset($value['item_picture3']) && !empty($value['item_picture3']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture3']) }}" height="80px">
                                    @endif

                                    @if (isset($value['item_picture4']) && !empty($value['item_picture4']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture4']) }}" height="80px">
                                    @endif

                                    @if (isset($value['item_picture5']) && !empty($value['item_picture5']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture5']) }}" height="80px">
                                    @endif

                                    @if (isset($value['item_picture6']) && !empty($value['item_picture6']))
                                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture6']) }}" height="80px">
                                    @endif
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- END: Content-->

<style type="text/css">
  .or-view td {
      border-top: 1px solid #DFE3E7;
   }
</style>
@endsection