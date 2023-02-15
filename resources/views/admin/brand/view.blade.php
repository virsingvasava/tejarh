@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Brand Details</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="/admin"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Brand</a>
                     </li>
                     <li class="breadcrumb-item active">Details
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
                                 <h5>Brand Details</h5>
                                 <tr>
                                    <th>Sub-Category Name</th>
                                    <td>{{ucfirst($view_sub_category->sub_cate_name)}}</td>
                                 </tr>
                                 <tr>
                                    <th>Brand Name</th>
                                    <td>{{ucfirst($view_brand->name)}}</td>
                                 </tr>
                                 <tr>
                                    <th>Model Name</th>
                                    @if($view_brand->model)
                                    <td>{{ucfirst($view_brand->model)}}</td>
                                    @else
                                    <td>N/A</td>
                                    @endif
                                 </tr>
                                 <tr>
                                    <th>Status</th>
                                    <td>
                                       @if($view_brand->status == 1)
                                       <span style="color:green;">Active</span> @else <span style="color:red;">InActive</span> @endif
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