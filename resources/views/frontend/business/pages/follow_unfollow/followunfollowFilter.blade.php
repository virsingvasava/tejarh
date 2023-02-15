<div class="row" id="followUnfollow">
    @if (!empty($followerArr) && count($followerArr) > 0)
        <div class="col-md-12">
            <div class="row grid">
                @foreach ($followerArr as $key => $value)
                    <div class="col-md-3 element-item admin">
                        <div class="role-user">
                            @if ($value['user']['role_user_profile_picture'] != '')
                                <img
                                    src="{{ asset(BUSINESS_PROFILE_FOLDER . '/' . $value['user']['role_user_profile_picture']) }}">
                            @else
                                <img src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/strory-img1.png') }}">
                            @endif

                            <h5>{{ $value['user']['first_name'] }}</h5>
                            <ul>
                                <li>Name : {{ $value['user']['first_name'] }}</li>
                                <li>phone_number : {{ $value['user']['phone_number'] }}</li>
                                <li>Address : {{ $value['user']['address'] }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="breadcrumb-item" style="text-align:center;">
            <h5 class="" style="color:gray"">Not Found Follow Unfollow</h5>
        </div>
    @endif
</div>
