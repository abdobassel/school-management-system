<div class="scrollbar side-menu-bg" style="overflow: scroll">
    <ul class="nav navbar-nav side-menu" id="sidebarnav">
        <!-- menu item Dashboard-->
        <li>
            <a href="{{ url('/student/dashboard') }}">
                <div class="pull-left"><i class="ti-home"></i><span
                        class="right-nav-text">{{ trans('main_trans.Dashboard') }}</span>
                </div>
                <div class="clearfix"></div>
            </a>
        </li>
        <!-- menu title -->
        <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{ trans('main_trans.Programname') }} </li>



        <!-- Quizes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Quizes-icon">
                <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">الاختبارات</span>
                </div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Quizes-icon" class="collapse" data-parent="#sidebarnav">
                <li> <a href="{{ route('studentExams.index') }}"> قائمةالاختبارات</a> </li>


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
                <li> <a href=""> الكتب</a> </li>



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






    </ul>
</div>
