@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Order Details</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.order.index')}}">Order</a>
                     </li>
                     <li class="breadcrumb-item active">Details
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
                        <h4 class="card-title">Order Detail</h4>
                     </div>
                     <div class="card-body card-dashboard">
                        <div class="table-responsive">
                           <table class="table zero-configuration or-view">
                              <tbody>
                                 <tr>
                                    <th>Order Number</th>
                                    <td>#{{ucfirst($view_order->id)}}</td>
                                 </tr>
                                 <tr>
                                    <th>Order Status</th>
                                    <td>
                                       @if($view_order->order_status == 0)
                                       <small class="badge badge-primary">Created</small>
                                       @elseif($view_order->order_status == 1)
                                       <small class="badge badge-secondary">Processing</small>
                                       @elseif($view_order->order_status == 2)
                                       <small class="badge badge-warning">Dispatched</small>
                                       @elseif($view_order->order_status == 3)
                                       <small class="badge badge-cancle">Cancelled</small>
                                       @elseif($view_order->order_status == 4)
                                       <small class="badge badge-delivered">Delivered</small>
                                       @elseif($view_order->order_status == 5)
                                       <small class="badge badge-danger">Rejected</small>
                                       @elseif($view_order->order_status == 6)
                                       <small class="badge badge-completed">Completed</small>
                                       @endif
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>Order Price</th>
                                    <td>{{ $view_order->price }}</td>
                                 </tr>
                                 <tr>
                                    <th>Order Quantity</th>
                                    <td>{{ $view_order->quantity }}</td>
                                 </tr>
                                 <tr>
                                    <th>Order Shipping Price</th>
                                    <td>{{ $view_order->shipping_price }}</td>
                                 </tr>
                                 <tr>
                                    <th>Order Total Amount</th>
                                    <td>{{ $view_order->total_amount }}</td>
                                 </tr>
                                 <tr>
                                    <th>Order Created</th>
                                    <td>{{ \Carbon\Carbon::parse($view_order->created_at)->format('d/m/Y H:i:s A')}}</td>
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
                        <h4 class="card-title">Delivery Address</h4>
                     </div>
                     <div class="card-body card-dashboard">
                        <div class="table-responsive">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>User Name</th>
                                    <th>Phone Number</th>
                                    <th>Pincode</th>
                                    <th>Locality</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Landmark</th>
                                    <th>Alternate Phone</th>
                                    <th>Address Type</th>
                                 </tr>
                              </thead>
                              <tr>
                                 <td>{{ucfirst($view_order_address->name)}}</td>
                                 <td>{{ucfirst($view_order_address->phone_number)}}</td>
                                 <td>{{$view_order_address->pincode}}</td>
                                 <td>{{ucfirst($view_order_address->locality)}}</td>
                                 <td>{{ucfirst($view_order_address->address)}}</td>
                                 <td>{{$view_order_address->city}}</td>
                                 <td>{{$view_order_address->landmark}}</td>
                                 <td>{{$view_order_address->alternate_phone}}</td>
                                 <td>{{$view_order_address->address_type}}</td>
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
                        <h4 class="card-title">Product Details</h4>
                     </div>
                     <div class="card-body card-dashboard">
                        <div class="table-responsive">
                           <table class="table">
                              <thead>
                                 <tr>
                                    <th>Product User</th>
                                    <th>Product Name</th>
                                    <th>Product Description</th>
                                    <th>@lang('messages.product.price')</th>
                                    <th>@lang('messages.product.view.category')</th>
                                    <th>@lang('messages.product.view.sub_category')</th>
                                    <th>@lang('messages.product.view.brand') </th>
                                    <th>@lang('messages.product.view.condition')</th>
                                    <th>@lang('messages.product.view.quantity')</th>
                                    <th>Address</th>
                                    <th>@lang('messages.product.view.pay_shipping')</th>
                                    <th> @lang('messages.product.view.price_type')</th>
                                    <th>Delivery Type</th>
                                    <th>Weight</th>
                                    <th>Width</th>
                                    <th>Length</th>
                                    <th>Height</th>
                                 </tr>
                              </thead>
                              <tr>
                                 <td>{{ucfirst($itemUser->first_name)}}</td>
                                 <td>{{ucfirst($itemDetails->what_are_you_selling)}}</td>
                                 <td>{{ucfirst($itemDetails->describe_your_items)}}</td>
                                 <td>{{$itemDetails->price}}</td>
                                 <td>{{ucfirst($view_category->category_name)}}</td>
                                 <td>{{ucfirst($view_sub_category->sub_cate_name)}}</td>
                                 <td>{{$view_brand->name}}</td>
                                 <td>{{$view_condition->name}}</td>
                                 <td>{{$itemDetails->quantity}}</td>
                                 <td>{{$itemDetails->address}}</td>
                                 @if ($itemDetails->pay_shipping == '0')
                                 <td>The buyer</td>
                                 @elseif($itemDetails->pay_shipping == '1')
                                 <td>I will pay</td>
                                 @else
                                 <td>Split</td>
                                 @endif
                                 @if ($itemDetails->price_type == '0')
                                 <td>Fixed Price</td>
                                 @else
                                 <td>Negotiable</td>
                                 @endif
                                 <td>{{ucfirst($view_deliveryType->name)}}</td>
                                 <td>{{ucfirst($itemDetails->weight)}}</td>
                                 <td>{{ucfirst($itemDetails->width)}}</td>
                                 <td>{{ucfirst($itemDetails->length)}}</td>
                                 <td>{{ucfirst($itemDetails->height)}}</td>
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
                        <h4 class="card-title">Product Images</h4>
                     </div>
                     <div class="card-body card-dashboard">
                        @foreach($itemImages as $key => $value)
                        <div id="product-slider2" class="product-gallary">
                           @if (isset($value['item_picture1']) && !empty($value['item_picture1']))
                              <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture1']) }}" height="80px" >
                           @endif

                           @if (isset($value['item_picture2']) && !empty($value['item_picture2']))
                              <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $value['item_picture2']) }}"  height="80px" >
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