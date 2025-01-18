@extends('layouts.master')
@section('title','قائمة الانتظار')
@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Session</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">21,459</h3>
                    <p class="text-success mb-0">(+29%)</p>
                  </div>
                  <p class="mb-0">Total Users</p>
                </div>
                <span class="badge bg-label-primary rounded p-2">
                  <i class="ti ti-user ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Paid Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">4,567</h3>
                    <p class="text-success mb-0">(+18%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-danger rounded p-2">
                  <i class="ti ti-user-plus ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Active Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">19,860</h3>
                    <p class="text-danger mb-0">(-14%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-success rounded p-2">
                  <i class="ti ti-user-check ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-6 col-xl-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-start justify-content-between">
                <div class="content-left">
                  <span>Pending Users</span>
                  <div class="d-flex align-items-center my-2">
                    <h3 class="mb-0 me-2">237</h3>
                    <p class="text-success mb-0">(+42%)</p>
                  </div>
                  <p class="mb-0">Last week analytics</p>
                </div>
                <span class="badge bg-label-warning rounded p-2">
                  <i class="ti ti-user-exclamation ti-sm"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
    </div>
      <!-- Users List Table -->
      <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">جميع المدفوعات قيد الانتظار</h5>
          <div class="d-flex justify-content-between align-items-center row pb-2 gap-3 gap-md-0">
            <div class="col-md-4 user_role">
                <a href="#">
                {{-- <button class="btn btn-success">اضف مادة</button> --}}
               </a>
            </div>
            <div class="col-md-4 user_plan"></div>
            <div class="col-md-4 user_status"></div>
          </div>
        </div>
        <div class="card-datatable table-responsive">
          <table class="datatables-users table">
            <thead class="border-top">
              <tr>
                 <th>الطالب</th>
                 <th>الهاتف</th>
                 <th>الايميل</th>
                <th>الاختبار</th>
                <th>المادة </th>
                <th>الصف</th>
                <th>المرحلة</th>
                <th>المبلغ المطلوب</th>
                <th>المدرس</th>
                <th>الهاتف</th>
                <th>الايميل</th>
                <th>مكتمل</th>
                <th>فشل</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($pends as $pend )
                @php
                     $user =App\Models\User::find($pend->user_id);
                     $teacher =App\Models\User::find($pend->test->teacher_id);
                 @endphp
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ $pend->test->title }}</td>
                    <td>{{ $pend->test->material->title }}</td>
                    <td>{{ $pend->test->grade->title }}</td>
                    <td>{{ $pend->test->stage->title }}</td>
                    <td>{{ $teacher->name  }}</td>
                    <td>{{ $teacher->phone  }}</td>
                    <td>{{ $teacher->email  }}</td>
                    <td>{{  $pend->amount }}</td>
                    <td>
                        <a href="{{ route('payment.changecompleted',['id'=>$pend->id]) }} }}">
                            <button class="btn btn-success">مكتمل</button>
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('payment.changefaild',['id'=>$pend->id]) }} }}">
                            <button class="btn btn-danger">فشل</button>
                        </a>
                    </td>
                    {{-- <td>
                        <form action="{{ route('pend.delete',['id'=>$pend->id]) }}"  method="POST">
                            @csrf
                            @method('DELETE')
                            <button  type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')" >حذف </button>
                        </form>
                    </td> --}}

               </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- / Content -->



    <div class="content-backdrop fade"></div>
  </div>

@endsection
@section('script')
<script>
    function confirmDelete(id) {
        if (confirm("Are you sure you want to delete this item?")) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>
@endsection
