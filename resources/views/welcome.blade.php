   @extends('layouts.master')
   @section('title',"اهلا بك في رموز")
   @section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <!-- View sales -->
      <div class="col-xl-4 mb-4 col-lg-5 col-12">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-7">
              <div class="card-body text-nowrap">
                <h5 class="card-title mb-0">Congratulations John! 🎉</h5>
                <p class="mb-2">Best seller of the month</p>
                <h4 class="text-primary mb-1">$48.9k</h4>
                <a href="javascript:;" class="btn btn-primary">View Sales</a>
              </div>
            </div>
            <div class="col-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img
                  src="../../assets/img/illustrations/card-advance-sale.png"
                  height="140"
                  alt="view sales" />
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- View sales -->

      <!-- Statistics -->
      <div class="col-xl-8 mb-4 col-lg-7 col-12">
        <div class="card h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
              <h5 class="card-title mb-0">Statistics</h5>
              <small class="text-muted">Updated 1 month ago</small>
            </div>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-primary me-3 p-2">
                    <i class="ti ti-chart-pie-2 ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">230k</h5>
                    <small>الطلاب</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-info me-3 p-2">
                    <i class="ti ti-users ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">8.549k</h5>
                    <small>المدرسين</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-danger me-3 p-2">
                    <i class="ti ti-shopping-cart ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">1.423k</h5>
                    <small>الامتحانات</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="ti ti-currency-dollar ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">$9745</h5>
                    <small>المراحل</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Statistics -->
    </div>
  </div>
   @endsection
