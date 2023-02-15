@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">User-Ticket</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">User-Ticket
                     </li>
                  </ol>
               </div>
            </div>
         </div>
      </div>
      <div class="content-body">
         <div class="row">
            <div class="col-12">
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
                           <table class="table zero-configuration">
                              <thead>
                                 <tr>
                                    <th>Ticket-ID</th>
                                    <th>Subject</th>
                                    <th>Open/Close Ticket</th>
                                    <th>View Details</th>
                                 </tr>
                              </thead>
                              @if(!empty($itemArray) && count($itemArray) > 0)
                              @foreach($itemArray as $key => $value)
                              <tr>
                                 <td>{{ $value['sku_id'] }}</td>
                                 <td>{{ $value['subject'] }}</td>
                                 <td class="text-center">
                                    <div class="d-flex justify-content-between py-50">
                                       <div class="custom-control custom-switch custom-switch-glow">
                                          <input type="checkbox" data-id="{{ $value['id'] }}" name="status" class="js-switch" {{ $value['status'] === 0 ? 'checked' : '' }}>
                                       </div>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                       <span class="bx bx-dots-horizontal-rounded font-medium-3 dropdown-toggle nav-hide-arrow cursor-pointer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                       </span>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <a class="dropdown-item" href="{{route('admin.user-ticket.view',($value['id']))}}"><i class="bx bx-show-alt mr-1"></i> @lang('messages.common.view')</a>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                              @endforeach
                              @else
                              <tr>
                                 <td colspan="10">No Ticket Found</td>
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

<script src="{{asset('js/jquery.min.js')}}"></script>

<link rel="stylesheet" type="text/css" href="{{asset('js/switchery/switchery.min.css')}}">
<script src="{{asset('js/switchery/switchery.min.js')}}"></script>

<script type="text/javascript">
   /* Toggole button for status make active and inactive */
   let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
   elems.forEach(function(html) {
      let switchery = new Switchery(html, {
         size: 'small'
      });
   });
   $(document).ready(function() {
      $('.js-switch').change(function() {

         let status = $(this).prop('checked') === true ? 0 : 1;
         let ticket_id = $(this).data('id');
         var token = "{{csrf_token()}}";
         $.ajax({
            type: "POST",
            dataType: "json",
            url: '{{ route("admin.user-ticket.status_update") }}',
            data: {
               'status': status,
               'ticket_id': ticket_id,
               _token: token
            },
            success: function(data) {
               console.log(data.message);
            }
         });
      });
   });
</script>

@endsection