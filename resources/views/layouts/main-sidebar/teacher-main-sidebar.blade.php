<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/teacher/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>

        <!-- الطلاب-->
        <li>
            <a href="{{ route('teacherStudents.index') }}"><i class="fas fa-user-graduate"></i><span
                    class="right-nav-text">الطلاب</span></a>
        </li>



        <!-- Quizes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Quizes-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">اختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Quizes-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('quizesTeacher.index') }}"> قائمةالاختبارات</a> </li>

                <li> <a href=""> قائمة الاسئلة</a> </li>

            </ul>
        </li>
        <!-- التقارير -->
        <li>
            <a href="{{ route('settings.index') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">
                    التقارير</span></a>
        </li>

        <!-- الغياب والحضور-->
        <li>
            <a href="{{ route('exams.index') }}"><i class="fas fa-book-open"></i><span class="right-nav-text">الغياب
                    والحضور</span></a>
        </li>

        <!-- الملف الشخصي-->
        <li>
            <a href="{{ route('settings.index') }}"><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الملف
                    الشخصي</span></a>
        </li>

    </ul>
</div>
