@extends('layouts.app_admin')
@section('content')

<!-- BEGIN: Content-->
<div class="app-content content">
   <div class="content-overlay"></div>
   <div class="content-wrapper">
      <div class="content-header row">
         <div class="content-header-left col-12 mb-2 mt-1">
            <div class="breadcrumbs-top">
               <h5 class="content-header-title float-left pr-1 mb-0">Ticket-Details</h5>
               <div class="breadcrumb-wrapper d-none d-sm-block">
                  <ol class="breadcrumb p-0 mb-0 pl-1">
                     <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                     </li>
                     <li class="breadcrumb-item active">Ticket-Details
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
            <div class="col-md-12">
               <div class="support-sec">
                  @foreach($itemArray as $key => $value)
                  <div class="support-main">
                     <div class="support-left">
                        <div class="support-date-time">
                           <span class="date">{{ \Carbon\Carbon::parse($value['created_at'])->format('d/m/Y')}}</span>
                           <span class="time">{{ \Carbon\Carbon::parse($value['created_at'])->format('H:i:s A')}}</span>
                        </div>
                        <div class="sup-profile">
                           <figure><img src="{{ asset('assets/images/user.png') }}" style="width: 100%;"></figure>
                           <div class="sup-profile-name">{{ $value['User']['first_name'] }}</div>
                        </div>
                     </div>
                     <div class="support-right">
                        <div class="">
                           <p>{{ $value['message'] }}</p>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               @if($value['ticketMaster']['status'] == '0')
               <div class="reply-btn-sec">
                  <a href="javascript:void(0)" class="btn-reply tejarh_delete_button" data-toggle="modal" data-target="#tejarhDeleteModel" data-id="{{$value['id']}}"><img src="{{ asset('assets/images/icon-reply.png') }}">Reply</a>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
<!-- END: Content-->
<div class="modal fade" id="tejarhDeleteModel" tabindex="-1" role="dialog" aria-labelledby="tejarhModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5>Reply</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <i class="bx bx-x"></i>
            </button>
         </div>
         <strong>
            <div id="ajax-alert-error" class="alert" style="display:none;">
            </div>
            <div id="ajax-alert" class="alert" style="display:none;">
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
               <p>{{ $message }}</p>
            </div>
            @endif
            @if ($message = Session::get('error'))
            <div class="alert alert-danger">
               <p>{{ $message }}</p>
            </div>
            @endif
         </strong>
         <form action="{{route('admin.ticket.reply')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $value['ticket_master_id'] }}" name="ticket_master_id">
            <div class="modal-footer">
               <div class="reply-sec-m">
                  <div class="reply-sec">
                     <textarea class="form-control" rows="5" placeholder="Enter Message" name="message"></textarea>
                     <div class="reply-input-group">
                        <div class="reply-file-upload-g">
                           <div class="reply-file-upload">
                              <input type="file" onchange="readURL0022(this);" name="image" id="image" accept="application/pdf,image/png,image/jpg,image/jpeg" class="valid" aria-invalid="false">
                              Add Attachment
                           </div>
                        </div>
                        <span style="color:red;">* Image should be 1MB</span>
                     </div><br>
                     <div class="form-group submit">
                        <button type="submit" value="Submit" class="btn btn-primary loader_class">Submit</button>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>

<script type="text/javascript">
   /* Delete Site links menu */
   $(document).on('click', '.tejarh_delete_button', function() {
      $('#tejarhDeleteModel').modal('show');
      $('.category_id').val($(this).attr('data-id'));
   })
</script>
<style>
   /* .support-sec{height: 400px; overflow-y: scroll;} */
   .support-main {
      display: flex;
   }

   .support-left {
      display: flex;
      width: 30%;
      flex-direction: column;
      border: 1px solid #D3D4D4;
      padding: 35px;
   }

   .support-left .support-date-time {
      display: flex;
      justify-content: space-between;
      width: 100%;
   }

   .support-left span.date {
      background: #ccc;
      padding: 5px 15px;
      color: #000;
      font-size: 15px;
      font-weight: 400;
      border-radius: 5px;
   }

   .support-left span.time {
      color: #000;
      font-size: 15px;
      font-weight: 400;
   }

   .support-left .sup-profile {
      display: flex;
      width: 100%;
      align-items: center;
      margin: 20px 0 0 0;
   }

   .support-left .sup-profile figure {
      display: flex;
      width: 35px;
      margin: 0;
   }

   .support-left .sup-profile .sup-profile-name {
      color: #000;
      font-size: 15px;
      line-height: 17px;
      font-weight: 400;
      margin: 0 0 0 10px;
   }

   .support-right {
      display: flex;
      width: 70%;
      flex-direction: column;
      border: 1px solid #D3D4D4;
      border-left: 0;
      padding: 35px;
   }

   .reply-btn-sec {
      display: flex;
      width: 100%;
      padding: 35px;
      justify-content: flex-end;
   }

   .reply-btn-sec .btn-reply {
      width: 150px;
      height: 50px;
      padding: 10px 15px;
      border: 1px solid #1a233a;
      color: #1a233a;
      background: transparent;
      border-radius: 5px;
      display: flex;
      justify-content: center;
      align-items: center;
   }

   .reply-btn-sec .btn-reply:hover {
      color: #000;
      border: 1px solid #000;
   }

   .reply-btn-sec .btn-reply img {
      margin: 0 5px 0 0;
      width: 15px;
      height: 14px;
   }

   .reply-sec-m {
      display: flex;
      width: 100%;
      margin: 20px 0 0 0;
   }

   .reply-sec {
      display: flex;
      width: 100%;
      flex-direction: column;

   }

   .reply-input-group {
      position: relative;
      display: flex;
      flex-wrap: wrap;
      align-items: stretch;
      width: 100%;
   }

   .reply-file-upload-g {
      border: none;
      width: 100%;
      border-radius: 10px !important;
      justify-content: center;
      border: 2px solid #dadce0;
      padding: 10px;
      margin: 15px 0;
   }

   .reply-file-upload {
      position: relative;
      text-align: center;
   }

   .reply-file-upload input {
      position: absolute;
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      opacity: 0;
   }
</style>
@endsection