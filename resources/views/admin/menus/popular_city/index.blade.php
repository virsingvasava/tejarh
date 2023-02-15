@extends('layouts.app_admin')
@section('content')


<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.menus.popular_city.popular_cities')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.menus.popular_city.popular_cities_list')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <div class="row">
            <div class="col-12">
               <div class="form-group">
                  <div class="col p-0">
                     <a href="{{route('admin.menus.popular_city.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                     <i class="bx bx-plus"></i>
                     <span class="invoice-repeat-btn">@lang('messages.menus.popular_city.add_popular_cities')</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
         <!-- Zero configuration table -->
         <section id="basic-datatable">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title"></h4>
                     </div>
                     <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @if (App::isLocale('en'))
                              <table class="table zero-configuration" id="popular_city_english_table">
                            @else
                              <table class="table zero-configuration" id="popular_city_arabic_table">
                            @endif
                              <thead>
                                 <tr>
                                    <th>@lang('messages.common.sr_no')</th>
                                    <th>@lang('messages.menus.popular_city.name')</th>
                                    <th>@lang('messages.menus.popular_city.url')</th>
                                    <th>@lang('messages.common.status')</th>
                                    <th>@lang('messages.common.action')</th>
                                 </tr>
                              </thead>
                              @if(!empty($menus) && count($menus) > 0)
                              @foreach($menus as $key => $value)
                              <tr>
                                 <td>#{{$key+1}}</td>
                                 <td>{{ucfirst($value->name)}}</td>
                                 <td>{{$value->url}}</td>
                                 <td>
                                    <input type="checkbox" data-id="{{ $value->id }}" name="status" class="js-switch" {{ $value->status == 1 ? 'checked' : '' }}>  
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                       <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          
                                          <a class="dropdown-item" href="{{route('admin.menus.popular_city.view',base64_encode($value->id))}}"><i class="bx bx-show-alt mr-1"></i> @lang('messages.common.view')</a>

                                          <a class="dropdown-item" href="{{route('admin.menus.popular_city.edit',base64_encode($value->id))}}"><i class="bx bx-edit-alt mr-1"></i> @lang('messages.common.edit')</a>
                                        
                                          <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{$value->id}}"><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>

                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td colspan="10">@lang('messages.menus.popular_city.not_found_popular_cities')</td>
                              </tr>
                              @endif
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
         <!--/ Zero configuration table -->
      </div>
   </div>
</div>
<!-- END: Content-->

<!-- delete modal Modal start-->
<div class="modal fade" id="tejarhDeleteModel" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.common.are_you_sure')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
            </button>
         </div>
         <div class="modal-body">
            <p class="mb-0">
               <strong>@lang('messages.menus.popular_city.are_you_sure_to_delete_popular_cities')</strong>
            </p>
         </div>
         <form action="{{route('admin.menus.popular_city.destroy')}}" method="POST">
            @csrf
            <input type="hidden"  name="popular_city_menu_id" class="popular_city_menu_id">
            <div class="modal-footer">
               <button type="button" class="btn btn-light-secondary" data-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
               <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>
               <button type="submit" class="btn btn-light-primary ml-1"> <i class="bx bx-check d-block d-sm-none"></i>
               <span class="d-none d-sm-block"><strong>@lang('messages.common.delete')</strong></span></button>
            </div>
         </form>
      </div>
   </div>
</div>
<!-- delete modal Modal start-->

<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('js/switchery/switchery.min.css')}}">
<script src="{{asset('js/switchery/switchery.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

<script type="text/javascript">

/* Toggle Button for status make active and inactive */

let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
});
$(document).ready(function(){
    $('.js-switch').change(function () {

        let status = $(this).prop('checked') === true ? 1 : 0;
        let menu_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('admin.menus.popular_city.menu_status_update') }}',
            data: {'status': status, 'menu_id': menu_id, _token:token},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});

/* Delete Site links menu */
$(document).on('click','.tejarh_delete_button',function(){
    $('#tejarhDeleteModel').modal('show');
    $('.popular_city_menu_id').val($(this).attr('data-id'));
})

/* Success and error message toastr */
$(document).ready(function() {
   toastr.options.timeOut = 10000;
   @if (Session::has('error'))
       toastr.error('{{ Session::get('error') }}');
   @elseif(Session::has('success'))
       toastr.success('{{ Session::get('success') }}');
   @endif
});
</script>
@endsection
