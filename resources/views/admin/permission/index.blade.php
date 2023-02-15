@extends('layouts.app_admin')
@section('content')

<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <!-- <div class="content-header row">
         </div> -->
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Permission</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">Permission list
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
                     <a href="{{route('admin.permission.create')}}" class="btn btn-light-primary btn-sm" data-repeater-create="" type="button">
                        <i class="bx bx-plus"></i>
                        <span class="invoice-repeat-btn">Add Permission</span>
                     </a>
                  </div>
               </div>
            </div>
         </div>

         <!-- users list start -->
         <section class="users-list-wrapper">

            <div class="users-list-table">
               <div class="card">
                  <div class="card-body">
                     <!-- datatable start -->
                     <div class="table-responsive">
                        @if (App::isLocale('en'))
                        <table class="table zero-configuration" id="user_english_table">
                           @else
                           <table class="table zero-configuration" id="user_arabic_table">
                              @endif

                              <thead>
                                 <tr>
                                    <th>sr_no</th>
                                    <th>Permission Name</th>
                                    <th>Slug</th>
                                    <th>Actions</th>
                                 </tr>
                              </thead>
                              <tbody>
                              @if(!empty($permission) && count($permission) > 0)
                                 @foreach($permission as $key => $value)
                                 <tr>
                                    <td>#{{$key+1}}</td>
                                    <td>{{($value->name)}}</td>
                                    <td>{{$value->slug}}</td>
                                    <td>
                                       <div class="dropdown">
                                          <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                          </span>
                                          <div class="dropdown-menu dropdown-menu-right">
                                             <!-- <a class="dropdown-item" href=""><i class="bx bx-show-alt mr-1"></i>Edit</a> -->
                                             <!-- <a class="dropdown-item" href="{{route('admin.permission.edit',base64_encode($value->id))}}"><i class="bx bx-edit-alt mr-1"></i>Edit</a> -->
                                             <a href="javascript:void(0)" class="dropdown-item tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id=""><i class="bx bx-trash mr-1"></i>@lang('messages.common.delete')</a>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 @endforeach
                                 @else
                                 <tr>
                                    <td colspan="10">@lang('messages.user.not_found_user')</td>
                                 </tr>
                                 @endif
                              </tbody>
                           </table>
                     </div>
                     <!-- datatable ends -->
                  </div>
               </div>
            </div>
         </section>
         <!-- users list ends -->
      </div>
   </div>
</div>

@endsection