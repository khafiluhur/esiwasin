@extends('layouts.app')

@section('style')
@endsection

@section('content')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
            </h1>
        </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    </div>
</div>
<!-- Main Container -->
            <main id="main-container">
                <!-- Hero -->
                <div class="bg-image" style="background-image: url('{{asset('/media/photos/photo8@2x.jpg')}}');">
                    <div class="bg-black-75">
                        <div class="content content-full text-center">
                            <div class="my-3">
                                <img class="img-avatar img-avatar-thumb" src="{{asset('/media/avatars/avatar13.jpg')}}" alt="">
                            </div>
                            <h1 class="h2 text-white mb-0">Edit Account</h1>
                            <h2 class="h4 font-w400 text-white-75">
                                {{$users->nama}}
                            </h2>
                            <!-- <a class="btn btn-light" href="be_pages_generic_profile.html">
                                <i class="fa fa-fw fa-arrow-left text-danger"></i> Back to Profile
                            </a> -->
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content content-boxed">
                    <!-- User Profile -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">User Profile</h3>
                        </div>
                        <div class="block-content">
                                <div class="row push">
                                    <div class="col-lg-4">
                                        <!-- <p class="font-size-sm text-muted">
                                            Your account’s vital info. Your username will be publicly visible.
                                        </p> -->
                                    </div>
                                    <div class="col-lg-8 col-xl-5">
                                        <div class="form-group">
                                            <label for="one-profile-edit-username">NIP</label>
                                            <input type="text" class="form-control" id="one-profile-edit-username" name="one-profile-edit-username" placeholder="Enter your username.." value="{{$users->nip}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="one-profile-edit-name">Name</label>
                                            <input type="text" class="form-control" id="one-profile-edit-name" name="one-profile-edit-name" placeholder="Enter your name.." value="{{$users->nama}}" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="one-profile-edit-email">Email Address</label>
                                            <input type="email" class="form-control" id="one-profile-edit-email" name="one-profile-edit-email" placeholder="Enter your email.." value="{{$users->level}}" disabled>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <!-- END User Profile -->

                    <!-- Change Password -->
                    <div class="block">
                        <div class="block-header">
                            <h3 class="block-title">Change Password</h3>
                        </div>
                        <div class="block-content">
                            <form action="{{ route('change.password') }}" method="POST">
                                @csrf
                                <div class="row push">
                                    <div class="col-lg-4">
                                        
                                    </div>
                                    <div class="col-lg-8 col-xl-5">
                                        <div class="form-group">
                                            <label for="one-profile-edit-password">Current Password</label>
                                            <input type="password" class="form-control" id="current_password" name="current_password">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="one-profile-edit-password-new">New Password</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="one-profile-edit-password-new-confirm">Confirm New Password</label>
                                                <input type="password" class="form-control" id="new_confirm_password" name="new_confirm_password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-alt-success">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END Change Password -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->
@endsection

@section('script')
@endsection