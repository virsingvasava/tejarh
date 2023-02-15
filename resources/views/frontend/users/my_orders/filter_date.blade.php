<div class="my-orders-products">
    <?php if ($orders->isEmpty()) { ?>
        sorry, products not found
    <?php } else { ?>
        @if (!empty($orders) && count($orders) > 0)
        @foreach ($orders as $key => $value)
        <div class="my-orders-products-box">
            <div class="order-place">
                <ul>
                    <li>
                        @php
                        $create_date = date('d M Y', strtotime($value->created_at));
                        @endphp
                        <h6>@lang('business_messages.order.order_placed')</h6>
                        <p>{{ $create_date }}</p>
                    </li>
                    <li>
                        <h6>@lang('business_messages.order.total')</h6>
                        <p>{{ $value->payable_amount }} {{env('CURRENCY_TAG')}}</p>
                    </li>
                    <li>
                        <h6>@lang('business_messages.order.ship_to')</h6>
                        <p>P.O Box 401247, Dubai</p>
                    </li>
                    <li>
                        <p>@lang('business_messages.order.order') {{ $value->order_number }}</p>
                        <p><a href="{{ route('frontend.users.order-details.index') }}">
                                @lang('business_messages.order.order_details')</a></p>
                    </li>
                </ul>
            </div>
            @php
            $item_image = App\Models\ItemsImages::where('item_id',$value->item_id)->first();
            @endphp
            <div class="product-box">
                <div class="product-box-content">

                    @if ($item_image->item_picture1 != "" && file_exists(public_path('assets/post/'.$item_image->item_picture1)))
                    <img src="{{ asset(USERS_ITEMS_POST_FOLDER . '/' . $item_image->item_picture1) }}">
                    @else
                    <img src="{{ asset('fronted/users_flow/assets/images/no-image.png') }}">
                    @endif
                    @php
                    $item = App\Models\Item::where('id',$value->item_id)->where('status', '=', '1')->first();
                    @endphp
                    <div class="product-box-content-text">
                        <h6 class="order-confirm">@lang('business_messages.order.order_confirm')</h6>
                        <p>
                            {{ $item->what_are_you_selling }}
                        </p>
                        <h5>{{ $value->payable_amount }} {{env('CURRENCY_TAG')}}</h5>
                    </div>

                </div>
                <div class="product-box-btn">
                    <a href="#" class="btn">@lang('business_messages.order.cancel_order')</a>
                </div>
            </div>
            <div class="estimated-delivery">
                <p>@lang('business_messages.order.estimated_delivery') <strong>{{ $create_date }}</strong></p>
            </div>
        </div>
        @endforeach
        @endif

    <?php } ?>
</div>