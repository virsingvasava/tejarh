@extends('frontend.home')
@section('content')
    <div class="modal fade" id="resetPasswordModal" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-logo">
                    <a href="#">
                        <img src="assets/images/tejarh-word-logo.png" alt="tejarh-white-logo">
                    </a>
                </div>
                <h5>Reset Password</h5>
                <p>Your new password must be different from previous used passwords.</p>
                <form>
                    <div class="input-group">
                        <input type="password" placeholder="Enter New Password" class="form-control">
                    </div>
                    <div class="input-group">
                        <input type="password" placeholder="Confirm New Password" class="form-control">
                    </div>
                    <div class="form-group submit">
                        <button type="button" data-bs-dismiss="modal" class="input-btn" data-bs-toggle="modal" data-bs-target="#otpScreenModal">Reset Password</button>
                    </div>                    
                </form>
            </div>
        </div>
    </div>
@endsection