@extends('layouts.app_admin')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">@lang('messages.slider.view.slider_details')</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.slider.index')}}">@lang('messages.slider.view.slider')</a>
                     </li>
                     <li class="breadcrumb-item active">@lang('messages.slider.view.view')
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <!-- Zero configuration table -->
         <section id="slider_view">
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
                                    <th>@lang('messages.slider.create.slider_picture')</th>
                                    <td>
                                       @if($view_slider->banner_picture != '' && file_exists(public_path('img/home_slider/'.$view_slider->banner_picture)))
                                       <img src="{{asset('img/home_slider/'.$view_slider->banner_picture)}}" height="90" width="90" alt="" class="img-profile rounded-circle" />
                                       @else
                                       <img src="{{asset('img/home_slider/placeholder.svg')}}" alt="" height="90" width="90" class="img-profile rounded-circle" />
                                       @endif
                                    </td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.eng_heading_title')</th>
                                    <td>{{$view_slider->banner_heading_title}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.ar_heading_title')</th>
                                    <td>{{$view_slider->ar_banner_heading_title}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.eng_sub_heading_title')</th>
                                    <td>{{$view_slider->banner_sub_heading_title}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.ar_sub_heading_title')</th>
                                    <td>{{$view_slider->ar_banner_sub_heading_title}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.eng_description')</th>
                                    <td>{{$view_slider->banner_description}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.slider.create.ar_description')</th>
                                    <td>{{$view_slider->ar_banner_description}}</td>
                                 </tr>
                                 <tr>
                                    <th>@lang('messages.common.status')</th>
                                    <td>
                                       @if($view_slider->status == 1)
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