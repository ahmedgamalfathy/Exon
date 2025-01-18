@extends('layouts.master')
@section('title',"عرض الصور الخاصة بالمدرس")
@section('content')
{{-- <form class="add-new-user pt-0" id="addNewUserForm" action="/admins/{{ $admin->id }}" method="POST">
    @method('PUT')
    @csrf --}}
    <div class="container pt-5">
        <div class="card shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center p-3 border-bottom">
                <h5 id="AddUserLabel" class="mb-0">عرض الصور</h5>
            </div>
            <div class="card-body">
                <form class="add-new-user" id="addNewUserForm" action="#" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        @if ($photos->photo)
                        @php
                            $photoData = json_decode($photos->photo); // فك تشفير البيانات
                        @endphp
                        @if (is_array($photoData))
                            @foreach ($photoData as $photo)
                                @php
                                    $imageUrl = $photo ?? null; // تعديل حسب هيكل JSON الخاص بك
                                @endphp
                                @if ($imageUrl)
                                    <img src="{{ asset('Exon/'.$imageUrl) }}" alt="صورة المستخدم" style="max-width: 400px; margin: 5px;"/>
                                @else
                                    <p>لا توجد صورة</p>
                                @endif
                            @endforeach
                        @else
                            <p>لا توجد صورة</p>
                        @endif
                    @else
                        <p>لا توجد صورة</p>
                    @endif
                         {{-- <img src="{{ $admin->photo ? asset('Exon/' . $admin->photo) : asset('assets/img/avatars/3.png') }}" class="img-fluid rounded-circle" width="60px" height="60px" alt="{{ asset('assets/img/avatars/1.png') }}"/> --}}
                    </div>
                    <!-- Action Buttons -->
                    <div class="d-flex justify-content-end mt-4">
                        {{-- <button  type="submit" class="btn btn-success" onclick="return confirm('Are you sure edit?')" >Edit </button> --}}
                        <a href="{{ route('teacher.isApprove') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
