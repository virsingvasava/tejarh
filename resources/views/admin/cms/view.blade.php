@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.cms.cms_page')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.cms.index')}}">@lang('messages.cms.cms_pages')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.common.view_details')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Zero configuration table -->
         <section id="menu_view">
            <div class="row">
               <div class="col-12">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="card-title"></h4>
                     </div>
                     <div class="card-body card-dashboard">
                        <div class="table-responsive">
                           <table class="table zero-configuration or-view">
                              <tbody>
                                 <tr>
                                    <th>@lang('messages.cms.title')</th>
                                    <td>{{ucfirst($page->title)}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.cms.short_description')</th>
                                    <td>{{$page->short_description}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.cms.description')</th>
                                    <td>{{$page->description}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.cms.slug')</th>
                                    <td>{{$page->slug}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.common.status')</th>
                                    <td>
                                       @if($page->status == 1)
                                       <span style="color:green;">@lang('messages.common.active')</span> @else <span style="color:red;">@lang('messages.common.In_active')</span> @endif
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </div>
   </div>
</div>
<!-- END: Content-->
<style type="text/css">
  .or-view td {
      border-top: 1px solid #DFE3E7;
   }
</style>
@endsection