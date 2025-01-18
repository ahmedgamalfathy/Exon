@extends('layouts.master')
@section('title',"انشاء مرحلة تعليمية")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">اضف مرحلة</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('stage.update',['id'=>$stage->id]) }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="add-user-fullname">اسم المرحلة</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="المرحلة" name="title" value="{{ $stage->title }}" required>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
{{--
                <div class="mb-3">
                    <label for="formFile" class="form-label">الصورة</label>
                    <input class="form-control" type="file"  name="photo" id="formFile">
                  </div>
                  @error('photo')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                  @enderror --}}
                <!-- Action Buttons -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-success me-2" onclick="return confirm('Are you sure?')">تعديل</button>
                    <a href="{{ route('stage.index') }}" class="btn btn-danger">تراجع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


