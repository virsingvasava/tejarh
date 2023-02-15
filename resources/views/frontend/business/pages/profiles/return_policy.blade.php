@extends('frontend.business.includes.web')
@section('pageTitle')
    {{ 'Tejarh - Return Policy' }}
@endsection
@section('content')
    <div class="my-items-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.business.home.index') }}"><i
                                        class="fas fa-home"></i> @lang('business_messages.menu.home')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Retun Policy</li>
                        </ol>
                    </nav>
                </div>
                
            </div>
            <!-- pagination-hidden-section  start-->
            <div class="row">
                <div class="pagination-hidden-section">
                    <input type='hidden' id='current_page' />
                    <input type='hidden' id='show_per_page' />
                </div>
            </div>
            <!-- pagination-hidden-section  end-->
            @if(!empty($check_policy))
            <div class="col-md-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('frontend.business.profile.edit_return_policy',$check_policy->id) }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$check_policy->id}}">
                            <div class="form-group">
                                <label><strong>Edit Description :</strong></label><br>
                                <textarea class="ckeditor form-control" name="description" value="{{$check_policy->description}}" >{!! Request::old('content', $check_policy->description) !!}</textarea>
                            </div><br>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success ">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-8 offset-2 mt-5">
                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ route('frontend.business.profile.add_return_policy') }}" id="policy_create" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label><strong>Description :</strong></label><br>
                                <textarea class="ckeditor form-control" name="description"></textarea>
                            </div><br>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary mr-1 loader_class">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <!-- pagination  start-->
            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination" id='page_navigation'></ul>
                    </nav>
                </div>
            </div>
            <!-- pagination end-->
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
                                <a href="javascript:void(0)"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/google-play.png') }}">
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"><img
                                        src="{{ asset(BUSINESS_ASSETS_FOLDER . '/images/img/app-store.png') }}">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<script src="//cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.ckeditor').ckeditor();
});
</script>
<script type="text/javascript">
$("#policy_create")({
    submitHandler: function(form) {
        var $this = $('.loader_class');
        var loadingText = '<i class="fa fa-spinner fa-spin" role="status" aria-hidden="true"></i> Loading...';
        $('.loader_class').prop("disabled", true);
        $this.html(loadingText);
        form.submit();
    }
});
</script>
@endsection
