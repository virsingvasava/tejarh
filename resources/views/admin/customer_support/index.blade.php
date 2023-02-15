@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.customer_support.customer_support')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li> 
                     <li class="breadcrumb-item active">@lang('messages.customer_support.customer_query_message_list')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
    
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
                               <table class="table zero-configuration" id="category_english_table">
                            @else
                               <table class="table zero-configuration" id="category_arabic_table">
                            @endif
                              <thead>
                                 <tr>
                                    <th>@lang('messages.common.sr_no')</th>
                                    <th>@lang('messages.customer_support.customer_name')</th>
                                    <th>@lang('messages.customer_support.query_subject')</th>
                                    <th>@lang('messages.customer_support.query_message')</th>
                                    <th>@lang('messages.common.action')</th>
                                 </tr>
                              </thead>
                              @if(!empty($customerSupport) && count($customerSupport) > 0)
                              @foreach($customerSupport as $key => $value)
                              <tr>
                                 <td>#{{$key+1}}</td>
                                    @php
                                       $userName = App\Models\User::where('id', $value->user_id)->first();
                                    @endphp
                                 <td>{{ucfirst($userName->first_name)}}</td>
                                 <td>{{$value->subject}}</td>
                                 <td>{{$value->message}}</td>
                               
                                 <td>
                                    <div class="dropdown">
                                       <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right">

                                          <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{$value->id}}"><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>

                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td colspan="10">@lang('messages.customer_support.not_found_customer_query')</td>
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
               <strong>@lang('messages.customer_support.are_you_sure_delete_message')</strong>
            </p>
         </div>
         <form action="{{route('admin.customer_support.destroy')}}" method="POST">
            @csrf
            <input type="hidden"  name="query_message_id" class="query_message_id">
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

/* Toggole button for status make active and inactive */
let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
});
$(document).ready(function(){
    $('.js-switch').change(function () {

        let status = $(this).prop('checked') === true ? 1 : 0;
        let category_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route("admin.category.category_status_update")}}',
            data: {'status': status, 'category_id': category_id, _token:token},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});

/* Delete Site links menu */
$(document).on('click','.tejarh_delete_button',function(){
    $('#tejarhDeleteModel').modal('show');
    $('.query_message_id').val($(this).attr('data-id'));
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
