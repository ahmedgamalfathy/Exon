@extends('layouts.master')
@section('title',"انشاء مستخدم جديد")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">Add Admin</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('admins.store') }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="add-user-fullname">الاسم</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="Ahmed Gamal" name="name" required>
                        @error('name')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="add-user-email">الايميل</label>
                        <input type="email" id="add-user-email" class="form-control" placeholder="ahmedgamal@example.com" name="email" required>
                        @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Password Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="password">الباسورد</label>
                        <input type="password" id="password" class="form-control" name="password" placeholder="********" required>
                        @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="col-md-6">
                        <label class="form-label" for="password_confirmation">تاكيد الباسود</label>
                        <input type="password" id="password_confirmation" class="form-control" name="password_confirmation" placeholder="********" required>
                        @error('password_confirmation')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">الصورة</label>
                    <input class="form-control" type="file"  name="photo" id="formFile">
                  </div>
                  @error('photo')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror
                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2">Save</button>
                    <a href="{{ route('admins.index') }}" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


