<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo" style="display: block;text-align: center;height: 100px">

        <a href="index.html" class="app-brand-link" style="margin-bottom: 10px">
        <span class="app-brand-logo demo" style="margin: auto">
          {{-- <img src="{{asset('assets/img/')}}" width="100%" height="100%"> --}}
        </span>
        </a>
        <p class="app-brand-text demo menu-text fw-bold">Exon</p>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>

    </div>


    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- الاحصائيات -->
        <li class="menu-item active open">
            <a href="{{ route('home') }}" class="menu-link ">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="الاحصائيات">الاحصائيات</div>
            </a>
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                <div data-i18n="المديرين">المديرين</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('admins.index') }}" class="menu-link">
                        <div data-i18n="قائمة المديرين">قائمة المديرين</div>
                    </a>
                </li>
                {{-- <li class="menu-item">
                    <a href="icons-font-awesome.html" class="menu-link">
                        <div data-i18n="Fontawesome">Fontawesome</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-book"></i>
                <div data-i18n="المراحل التعليميه">المراحل التعليميه</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('stage.index') }}" class="menu-link">
                        <div data-i18n="المراحل التعليمية ">المراحل التعليمية </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('grade.index') }}" class="menu-link">
                        <div data-i18n="الصفوف التعليمية">الصفوف التعليمية</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('material.index') }}" class="menu-link">
                        <div data-i18n="المواد الدراسية">المواد الدراسية</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-brand-cashapp"></i>
                <div data-i18n="المدفوعات">المدفوعات</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('payment.pending') }}" class="menu-link">
                        <div data-i18n="الانتظار">الانتظار</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('payment.completed') }}" class="menu-link">
                        <div data-i18n="المكتملة">المكتملة</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('payment.faild') }}" class="menu-link">
                        <div data-i18n="المعلقة -المرفوضة">المعلقة -المرفوضة</div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- Academy menu end -->

        <li class="menu-item">
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="المدرسين">المدرسين</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('teacher.isApprove') }}" class="menu-link">
                        <div data-i18n="طلبات الدخول للتطبيق">طلبات الدخول للتطبيق</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="{{ route('teacher.approved') }}" class="menu-link ">
                        <div data-i18n="مدرسين التطبيق">مدرسين التطبيق</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Icons -->
        <li class="menu-item">
            <a href="javascript:void(0)" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                <div data-i18n="الطلاب">الطلاب</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ route('students') }}" class="menu-link">
                        <div data-i18n="جميع الطلاب">جميع الطلاب</div>
                    </a>
                </li>
                {{-- <li class="menu-item">
                    <a href="icons-font-awesome.html" class="menu-link">
                        <div data-i18n="Fontawesome">Fontawesome</div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <li class="menu-item">
            <a href="{{ route('contacts') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                <div data-i18n="طلبات التواصل">طلبات التواصل</div>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{route('policys') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-brand-tabler"></i>
                <div data-i18n="سياسةالخصوصية">سياسةالخصوصية</div>
            </a>
        </li>
    </ul>
</aside>
