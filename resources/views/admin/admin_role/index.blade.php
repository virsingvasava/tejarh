@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.role.roles')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.role.role_list')
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
                     <a href="{{route('admin.admin_role.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                        <i class="bx bx-plus"></i>
                        <span class="invoice-repeat-btn">@lang('messages.role.role_add')</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>

         @if ($message = Session::get('success'))
         <div class="alert alert-success">
            <p>{{ $message }}</p>
         </div>
         @endif
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
                           <table class="table zero-configuration" id="role_english_table">
                              @else
                              <table class="table zero-configuration" id="role_arabic_table">
                                 @endif
                                 <thead>
                                    <tr>
                                       <th>sr_no</th>
                                       <th>Role Name</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 @if(!empty($role) && count($role) > 0)
                                 <?php $i = 1; ?>
                                 @foreach($role as $key => $value)
                                 <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$value->name}}</td>
                                    <td>
                                       <div class="dropdown">
                                          <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                          </span>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <!-- <a class="dropdown-item" href="{{route('admin.admin_role.edit',$value->id)}}"><i class="bx bx-edit-alt mr-1"></i> @lang('messages.common.edit')</a> -->
                                             <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id=""><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 <?php $i++; ?>
                                    @endforeach
                                    @endif

                                 <!-- <tr>
                                 <td colspan="10">@lang('messages.role.not_found_role')</td>
                              </tr>
                               -->
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


@endsection