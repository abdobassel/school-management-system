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



        <!-- children-->
        <li>
            <a href=""><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الابناء
                </span></a>
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



        <!-- الملف الشخصي-->
        <li>
            <a href=""><i class="fas fa-id-card-alt"></i><span class="right-nav-text">الملف
                    الشخصي</span></a>
        </li>





    </ul>
</div>
