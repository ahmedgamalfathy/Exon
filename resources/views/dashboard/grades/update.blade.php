@extends('layouts.master')
@section('title',"انشاء مرحلة تعليمية")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">اضف صف دراسي</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('grade.update',['id'=>$grade->id]) }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="add_rating">اختر المرحلةالتعليمية</label>
                        <select id="add_rating" name="stage_id" class=" form-select" data-placeholder="Size">
                            <option value="">اختر</option>
                            @foreach ( $stages as $stage)
                            <option value="{{ $stage->id }}" {{ $grade->stage_id == $stage->id ? 'selected' :'' }} >{{ $stage->title }}</option>
                            {{--  --}}
                            @endforeach
                          </select>
                        @error('stage_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- <div class="col-md-12">
                        <label class="form-label" for="add-user-fullname">المرحلة التعليمية</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="تاكد من اختيار المرحلة التعليمية" name="stage_id" required>
                        @error('stage_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div> --}}
                    <div class="col-md-12">
                        <label class="form-label" for="add-user-fullname">اسم الصف</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="المرحلة" name="title" value="{{ $grade->title }}" required>
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
                    <button type="submit" class="btn btn-success me-2">حفظ</button>
                    <a href="{{ route('grade.index') }}" class="btn btn-danger">تراجع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


