<div id="reviewMessageSection">
    <div class="review-score-container">
        <h3 class="reviewRatingAvg">{{ $totalReviewAvg }}</h3>
        <div class="rate mt-4">
            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
            <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
            <i class="fas fa-star star-light submit_star mr-1"></i>
            <i class="fas fa-star star-light submit_star mr-1"></i>
            <i class="fas fa-star star-light submit_star mr-1"></i>
        </div>
        <p class="reviewRatingCount">{{ $totalReviewCount }} reviews</p>
    </div>
    {{-- <div class="col-sm-4 text-center">
        <h1 class="text-warning mt-4 mb-4">
            <b><span id="average_rating">0.0</span> / 5</b>
        </h1>
        <div class="mb-3">
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
            <i class="fas fa-star star-light mr-1 main_star"></i>
        </div>
        <h3><span id="total_review">0</span> Review</h3>
    </div> 
    --}}
    <div class="user_review_message_section responseData">
        @if (!empty($reviewRatingArray) && count($reviewRatingArray) > 0)
            @foreach ($reviewRatingArray as $key => $value)
                <div class="review-dialog-list">
                    <div class="review-block">
                        <div class="">
                            <div class="customer-review">
                                <div class="review-img">I
                                    @if (!empty($value['user']['profile_picture']))
                                        <img src="@if (isset($value['user']['profile_picture'])) {{ asset('assets/users/' . $value['user']['profile_picture']) }} @endif">
                                    @else
                                        <img src="{{ asset('assets/images/user.png') }}">
                                    @endif
                                </div>
                                <div class="review-sec">
                                    <div class="review-content">
                                        <h5>{{ $value['user']['first_name'] }}{{ $value['user']['last_name'] }}</h5>
                                    </div>
                                    <div class="dots"><img src="{{ asset('assets/images/dots-icon.png') }}" /></div>
                                </div>
                            </div>
                            <div class="review-time-sec">
                                <div class="rate inner">
                                    @if ($value['rating_star'] == 5)
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                    @elseif($value['rating_star'] == 4)
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                    @elseif($value['rating_star'] == 3)
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                    @elseif($value['rating_star'] == 2)
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                    @else
                                        <i class="fas fa-star star-light submit_star mr-1 text-warning"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                        <i class="fas fa-star star-light submit_star mr-1"></i>
                                    @endif
                                </div>
                                <span>{{ \Carbon\Carbon::parse($value['created_at'])->diffForHumans() }}</span>
                            </div>
                            <div class="customer-review-content mt-1">
                                <p>{{ $value['review_description'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
