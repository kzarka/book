<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">   
    <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            @if (strstr($currentUrl, 'dashboard') === false)
            <li>
            @else
            <li class="active">
            @endif
                <a href="{{ route('admin_dashboard') }}"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a>
            </li>
            @if (strstr($currentUrl, 'categories') === false)
            <li>
            @else
            <li class="active">
            @endif
                <a href="{{ route('admin_categories') }}"><i class="fa fa-dashboard"></i> <span> Category</span></a>
            </li>
            @if (strstr($currentUrl, 'tips') === false)
            <li>
            @else
            <li class="active">
            @endif
                <a href="{{ route('admin_tips') }}"><i class="fa fa-dashboard"></i> <span> Tips</span></a>
            </li>
            @if (strstr($currentUrl, 'classes') === false)
            <li class="treeview">
            @else
            <li class="active treeview">
            @endif
                <a href="#">
                    <i class="fa fa-table"></i><span>Classes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (strstr($currentUrl, 'classes/list') === false)
                    <li>
                    @else
                    <li class="active">
                    @endif
                        <a href="{{ route('admin_classes') }}"><i class="fa fa-circle-o"></i> List Class</a>
                    </li>
                    @if (strstr($currentUrl, 'classes/create') === false)
                    <li>
                    @else
                    <li class="active">
                    @endif
                        <a href="{{ route('admin_create_class') }}"><i class="fa fa-circle-o"></i> Add Class</a>
                    </li>
                </ul>
            </li>
            @if (strstr($currentUrl, 'posts') === false)
            <li class="treeview">
            @else
            <li class="active treeview">
            @endif
                <a href="#">
                    <i class="fa fa-table"></i><span>Posts</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @if (strstr($currentUrl, 'posts/list') === false)
                    <li>
                    @else
                    <li class="active">
                    @endif
                        <a href="{{ route('admin_posts') }}"><i class="fa fa-circle-o"></i> List Posts</a>
                    </li>
                    @if (strstr($currentUrl, 'posts/create') === false)
                    <li>
                    @else
                    <li class="active">
                    @endif
                        <a href="{{ route('admin_create_post') }}"><i class="fa fa-circle-o"></i> Add Post</a>
                    </li>
                </ul>
            </li>
            @if (strstr($currentUrl, 'bosses') === false)
            <li>
            @else
            <li class="active">
            @endif
                <a href="{{ route('admin_bosses') }}"><i class="fa fa-dashboard"></i> <span> Bosses</span></a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Layout Options</span>
                    <span class="pull-right-container">
                        <span class="label label-primary pull-right">4</span>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Boxed</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Fixed</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
