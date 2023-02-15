@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.product.products')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li> 
                     <li class="breadcrumb-item active">@lang('messages.product.product_list')
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
                     <!-- <a href="{{route('admin.product.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                     <i class="bx bx-plus"></i>
                     <span class="invoice-repeat-btn">@lang('messages.product.add_product')</span>
                     </a> -->
                     <!-- <a href="javascript:void(0)" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button" data-toggle="modal" data-target="#ImportModel">
                     <i class="bx bx-import me-sm-2"></i>
                     <span class="invoice-repeat-btn">@lang('messages.product.import')</span>
                     </a> -->

                     <a href="{{ route('admin.product.export') }}"  class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                     <i class="bx bx-export me-sm-2"></i>
                     <span class="invoice-repeat-btn">@lang('messages.product.export')</span>
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
                               <table class="table zero-configuration" id="product_english_table">
                            @else
                               <table class="table zero-configuration" id="product_arabic_table">
                            @endif
                              <thead>
                                 <tr>
                                    <th>@lang('messages.common.sr_no')</th>
                                    <th>@lang('messages.product.image')</th>
                                    <th>@lang('messages.product.name')</th>
                                    <th>@lang('messages.product.description')</th>
                                    <th>@lang('messages.product.price')</th>
                                    <th>@lang('messages.common.status')</th>
                                    <th>@lang('messages.common.action')</th>
                                 </tr>
                              </thead>
                              @if(!empty($products) && count($products) > 0)
                              @foreach($products as $key => $value)
                              <tr>
                                <td>#{{$key+1}}</td>
                                <td>
                               
                                 @if($value['itemImage']['item_picture1'] != '' && file_exists(public_path('assets/post/'.$value['itemImage']['item_picture1'])))
                                    <img src="{{asset('assets/post/'.$value['itemImage']['item_picture1'])}}" height="70" width="70" alt="" class="img-profile rounded-circle" />
                                 @else
                                    <img src="{{asset('img/product/placeholder.svg')}}" alt="" height="70" width="70" class="img-profile rounded-circle"/>
                                 @endif

                                </td>
                                <td>{{ucfirst($value->what_are_you_selling)}}</td>
                                <td>{{$value->describe_your_items}}</td>
                                <td>{{$value->price}}</td>
                                 <td>
                                    <div class="d-flex justify-content-between py-50">
                                        <div class="custom-control custom-switch custom-switch-glow">
                                          <input type="checkbox" data-id="{{ $value->id }}" name="status" class="js-switch" {{ $value->status == 1 ? 'checked' : '' }}> 
                                      </div>
                                    </div> 
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                       <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right">

                                          <a class="dropdown-item" href="{{route('admin.product.view',base64_encode($value->id))}}"><i class="bx bx-show-alt mr-1"></i> @lang('messages.common.view')</a>

                                          <a class="dropdown-item" href="{{route('admin.product.edit',base64_encode($value->id))}}"><i class="bx bx-edit-alt mr-1"></i> @lang('messages.common.edit')</a>

                                          <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{$value->id}}"><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>

                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td colspan="10">@lang('messages.product.not_found_product')</td>
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
               <strong>@lang('messages.product.are_you_sure_delete_product')</strong>
            </p>
         </div>
         <form action="{{route('admin.product.destroy')}}" method="POST">
            @csrf
            <input type="hidden"  name="product_id" class="product_id">
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


<!-- import modal Modal start-->
<div class="modal fade" id="ImportModel" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="tejarhModalCenterTitle">@lang('messages.product.import_products')</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <i class="bx bx-x"></i>
            </button>
         </div>
         <div class="col-xl-12 col-md-12 col-sm-12">
            <div class="card">
               <div class="card-body">
                 <!--  <p class="card-text">
                    Import products
                  </p> -->
                  <form action="{{route('admin.product.import')}}" method="POST"  enctype="multipart/form-data" id="import_products">
                     @csrf
                     <div class="form-body">
                        <div class="form-group">
                             <label>Choose import file</label>
                             <div class="custom-file">
                                 <input type="file" class="custom-file-input" name="import_products">
                                 <label class="custom-file-label" for="import_products">@lang('messages.product.choose_import_file')</label>
                             </div>
                        </div>
                     </div>
                     <div class="form-actions d-flex justify-content-end">
                        <button type="button" class="btn btn-light-secondary" data-dismiss="modal"> <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.close')</strong></span></button>

                        <button type="submit" class="btn btn-light-primary ml-1"> <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block"><strong>@lang('messages.common.submit')</strong></span></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- import modal Modal start-->

<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('js/switchery/switchery.min.css')}}">
<script src="{{asset('js/switchery/switchery.min.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>

<script src="{{asset('build/app-assets/vendors/js/jquery/jquery.min.js')}}"></script>
<script src="{{asset('build/app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>

<script type="text/javascript">

/* Toggole button for status make active and inactive */
let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
});
$(document).ready(function(){
    $('.js-switch').change(function () {

        let status = $(this).prop('checked') === true ? 1 : 0;
        let product_id = $(this).data('id');
        var token = "{{csrf_token()}}";
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route('admin.product.product_status_update') }}',
            data: {'status': status, 'product_id': product_id, _token:token},
            success: function (data) {
                console.log(data.message);
            }
        });
    });
});

/* Delete Site links menu */
$(document).on('click','.tejarh_delete_button',function(){
    $('#tejarhDeleteModel').modal('show');
    $('.product_id').val($(this).attr('data-id'));
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

/* Import file validation */
$("#import_products").validate({
    ignore: "not:hidden",
    onfocusout: function(element) {
        this.element(element);  
    },
    rules: {
        
        "import_products":{
            required:true,
        },
    },
    messages: {

        "import_products":{
            required:'{{__("messages.product.create.validation.please_choose_file")}}',
         },
    },
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
