@extends('layouts.app_admin')
@section('content')


<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Group Notification</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">Group Notification
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
                     <a href="{{route('admin.app-notification.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                        <i class="bx bx-plus"></i>
                        <span class="invoice-repeat-btn">Group Notification</span>
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
                           <table class="table zero-configuration" id="category_english_table">
                              @else
                              <table class="table zero-configuration" id="category_arabic_table">
                                 @endif
                                 <thead>
                                    <tr>
                                       <th>@lang('messages.common.sr_no')</th>
                                       <th>Group No.</th>
                                       <th>Names</th>
                                       <th>@lang('messages.common.action')</th>
                                    </tr>
                                 </thead>
                                 @if(!empty($getGroupNotification) && count($getGroupNotification) > 0)
                                 @foreach($getGroupNotification as $key => $value)
                                 <?php
                                 $groupId = $value->id;
                                 $getDetails = App\Models\GroupNotificationDetail::where('group_id',$groupId)->groupBy()->get();
                                 ?>
                                 <tr>
                                    <td>#{{$key+1}}</td>
                                    <td>GRP- {{ $value->id }}</td>
                                    <td>
                                       @foreach($getDetails as $detailskey => $detailsvalue)
                                       <?php
                                       $getUser = App\Models\User::where('id',$detailsvalue->user_id)->first();
                                       ?>
                                       <label class="label label-info">{{ $getUser->first_name }} , </label>
                                       @endforeach
                                    </td>
                                    <td><a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{$value->id}}"><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a></td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                    <td colspan="10">No Records</td>
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
               <strong>Are you sure want to delete this group ?</strong>
            </p>
         </div>
         <form action="{{route('admin.app-notification.destroy')}}" method="POST">
            @csrf
            <input type="hidden" name="id" class="id">
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
   /* Delete Site links menu */
   $(document).on('click', '.tejarh_delete_button', function() {
      $('#tejarhDeleteModel').modal('show');
      $('.id').val($(this).attr('data-id'));
   })
</script>
@endsection