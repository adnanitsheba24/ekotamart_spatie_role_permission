@extends('frontend.master')
@section('mainpage')
@section('title')
Change Password
@endsection
@php
    $user = DB::table('users')->where('id',Auth::id())->first();
@endphp
<div class="content_one" id="password_content_one">
    <div class="modal-header">
        <h5 class="modal-title" id="static_change_password_label" >Change Password</h5>
    </div>
    <div class="row">
        <div class="col-md" style="display: block;">
        <form method="post" action="{{ route('change.password') }}">
  			@csrf
         <div class="form-group">
            <label class="info-title" for="exampleInputEmail1"><h3>Current Password:</h3> <span> </span></label>
            <input class="modal_input" type="password" id="current_password" name="oldpassword" class="form-control" value="{{ isset($user->google_id)? Illuminate\Support\Facades\Crypt::decrypt($user->password) : '' }}">
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1"><h3>New Password:</h3> <span> </span></label>
            <input class="modal_input" type="password" id="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label class="info-title" for="exampleInputEmail1"><h3>Confirm Password:</h3> <span> </span></label>
            <input class="modal_input" type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>
         <div class="form-group">            
           <button class="modal_button" type="submit" class="btn btn-danger" style="margin-top: 25px;">Update</button>
        </div>         		
  		</form> 
        </div>
    </div>
</div>
@endsection