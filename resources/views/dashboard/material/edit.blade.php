@extends('layouts.master')
@section('title',"تعديل المادة")



@section('content')
<div class="container pt-5">
    <div class="card shadow-sm border-0">
        <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
            <h5 id="AddUserLabel" class="mb-0">تعديل المادة</h5>
        </div>
        <div class="card-body">
            <form class="add-new-user" id="addNewUserForm" action="{{ route('material.update',['id'=>$material->id]) }}" method="POST" enctype="multipart/form-data"   >
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <!-- Name Field -->
                    <div class="col-md-12">
                        <label class="form-label" for="add_rating">اختر الصف الدراسي المناسب</label>
                        <select id="add_rating" name="grade_id" class=" form-select" data-placeholder="Size">
                            <option value="">اختر</option>
                            @foreach ( $grades as $grade)
                            <option value="{{$grade->id }}"{{ $material->grade_id == $grade->id ? 'selected' :'' }} >{{ $grade->title }}</option>
                            {{-- {{ $material->grade_id == $grade->id ? 'selected' :'' }} --}}
                            @endforeach
                          </select>
                        @error('grade_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label" for="add_rating">اختر الترم</label>
                        <select id="add_rating" name="term" class=" form-select" data-placeholder="Size">
                            <option value="">اختر</option>
                            <option value="ترم_أول"{{ $material->term == "ترم_أول" ? 'selected' :'' }} >ترم_أول</option>
                            <option value="ترم_ثاني"{{ $material->term == "ترم_ثاني" ? 'selected' :'' }} >ترم_ثاني</option>
                            {{-- {{ $rating->status_rat == 1 ? 'selected' :'' }} --}}
                          </select>
                        @error('term')
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
                        <label class="form-label" for="add-user-fullname">اسم المادة</label>
                        <input type="text" class="form-control" id="add-user-fullname" placeholder="المادة" value="{{ $material->title }}" name="title" required>
                        @error('title')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
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
                    <button type="submit" class="btn btn-success me-2">تعديل</button>
                    <a href="{{ route('material.index') }}" class="btn btn-danger">تراجع</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


