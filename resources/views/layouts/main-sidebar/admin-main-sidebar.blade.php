<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>

        <!-- Grades-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{ trans('main_trans.Grades') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('grades.index') }}">{{ trans('main_trans.Grades_list') }}</a></li>

            </ul>
        </li>
        <!-- classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                <div class="pull-left"><i class="ti-calendar"></i><span
                        class="right-nav-text">{{ trans('main_trans.classes') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('Classrooms.index') }}">{{ trans('main_trans.List_classes') }} </a>
                </li>

            </ul>
        </li>
        <!-- sections-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.sections') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('sections.index') }}">{{ trans('main_trans.List_sections') }}</a></li>
            </ul>
        </li>


        <!-- parents-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.Parents') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ url('add_parent') }}">{{ trans('main_trans.List_Parents') }}</a></li>
                <li><a href="{{ url('add_parent') }}">{{ trans('main_trans.Add_Parent') }}</a></li>

            </ul>
        </li>
        <!-- teachers-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.Teachers') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('teachers.index') }}">{{ trans('main_trans.List_Teachers') }}</a>
                </li>

            </ul>
        </li>
        <!-- students-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                        class="right-nav-text">{{ trans('main_trans.students') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{ route('students.index') }}">{{ trans('main_trans.list_students') }}</a>
                <li><a href="{{ route('students.create') }}">{{ trans('main_trans.add_student') }}</a>
                <li><a href="{{ route('students.promotions.create') }}">{{ trans('main_trans.list_Promotions') }}</a>

                </li>
                <li><a href="{{ route('students.promotions.index') }}">{{ trans('main_trans.add_Promotion') }}</a>

                </li>
                <li><a href="{{ route('graduted.create') }}">{{ trans('main_trans.add_Graduate') }}</a>
                <li><a href="{{ route('graduted.index') }}">{{ trans('main_trans.Graduate_students') }}</a>



            </ul>
        </li>


        <!-- Accounts-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Accounts') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('fees.index') }}">الرسوم الدراسية</a> </li>
                <li> <a href="{{ route('fees_invoices.index') }}">الفواتير</a> </li>
            </ul>
        </li>

        <!-- Attendance-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                <div class="pull-left"><i class="fas fa-calendar-alt"></i><span
                        class="right-nav-text">{{ trans('main_trans.Attendance') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('attendance.sectionsAttendance') }}">قائمة الطلاب</a> </li>
            </ul>
        </li>
        <!-- Subjects-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">المواد
                        الدراسية</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Subjects" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('subjects.index') }}">قائمة المواد</a> </li>
            </ul>
        </li>
        <!-- Exams-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span
                        class="right-nav-text">{{ trans('main_trans.Exams') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('exams.index') }}">{{ trans('main_trans.Exams') }}</a> </li>
                <li> <a href="">قائمة الاسئلة</a> </li>
            </ul>
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
                <li> <a href="{{ route('quizzes.index') }}"> قائمةالاختبارات</a> </li>

                <li> <a href="{{ route('questions.index') }}"> قائمة الاسئلة</a> </li>

            </ul>
        </li>
        <!-- Library-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Library-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">المكتبة</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Library-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('library.index') }}"> الكتب</a> </li>



            </ul>
        </li>


        <!-- Online classes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                <div class="pull-left"><i class="fas fa-video"></i><span
                        class="right-nav-text">{{ trans('main_trans.Onlineclasses') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="">حصص اونلاين مع زوم</a> </li>
            </ul>
        </li>


        <!-- Settings-->
        <li>
            <a href="{{ route('settings.index') }}">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">الاعدادت</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>

        </li>



        <!-- Users-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                <div class="pull-left"><i class="fas fa-users"></i><span
                        class="right-nav-text">{{ trans('main_trans.Users') }}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                <li> <a href="themify-icons.html">Themify icons</a> </li>
                <li> <a href="weather-icon.html">Weather icons</a> </li>
            </ul>
        </li>

    </ul>
</div>
