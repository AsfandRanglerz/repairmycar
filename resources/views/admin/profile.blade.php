@extends('admin.layout.app')
@section('title', 'Edit Profile')
@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.profile.update', $admin->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row"></div>
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="form-control"  accept=".jpg,png" required="" name="image" value="{{ old('image', $admin->image) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Your Name</label>
                                        <input type="text" class="form-control" required="" name="name" value="{{ old('name', $admin->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" required="" name="email" autocomplete="off" value="{{ old('email', $admin->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="number" class="form-control" name="phone" value="{{ old('phone', $admin->phone) }}">
                                    </div>
                                    {{--<div class="form-group">
                                        <label>Gander</label>
                                        <select class="form-control" name="gander" id="" required>
                                            @if($admin->gander == Null)
                                                <option value="Null">None</option>
                                            @else
                                                <option value="{{ old('gander', $admin->gander) }}">{{ $admin->gander }}</option>
                                            @endif
                                            <option value="male">Male</option>
                                            <option value="female">FeMale</option>
                                        </select>
                                    </div>--}}
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <form method="post" action="{{ route('admin.profile.updatePassword', ['id' => $admin->id]) }}">
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Password</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" name="password" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" autocomplete="off">
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-primary" type="submit">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
