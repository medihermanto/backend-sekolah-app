<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard.index') }}">Sekolah</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main menu</li>
            <li class="{{ setActive('admin/dashboard') }}">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>
            @can('posts.index')
                <li class="{{ setActive('admin/post') }}"><a class="nav-link" href="{{ route('admin.post.index') }}"><i
                            class="fas fa-book-open"></i>
                        <span>Posts</span></a></li>
            @endcan
            @can('tags.index')
                <li class="{{ setActive('admin/tag') }}"><a class="nav-link" href="{{ route('admin.tag.index') }}"><i
                            class="fas fa-tags"></i>
                        <span>Tags</span></a></li>
            @endcan
            @can('categories.index')
                <li class="{{ setActive('admin/category') }}"><a class="nav-link"
                        href="{{ route('admin.category.index') }}"><i class="fas fa-file"></i>
                        <span>Category</span></a></li>
            @endcan
            @can('events.index')
                <li class="{{ setActive('admin/event') }}"><a class="nav-link" href="{{ route('admin.event.index') }}"><i
                            class="fas fa-bell"></i>
                        <span>Event</span></a></li>
            @endcan
            @can('students.index')
                <li class="{{ setActive('admin/student') }}"><a class="nav-link"
                        href="{{ route('admin.student.index') }}"><i class="fas fa-users"></i>
                        <span>Students</span></a>
                </li>
            @endcan
            @can('teachers.index')
                <li class="{{ setActive('admin/teacher') }}"><a class="nav-link"
                        href="{{ route('admin.teacher.index') }}"><i class="fas fa-user"></i>
                        <span>Teachers</span></a></li>
            @endcan
            @can('classes.index')
                <li class="{{ setActive('admin/class') }}"><a class="nav-link" href="{{ route('admin.class.index') }}"><i
                            class="fas fa-building"></i>
                        <span>Classes</span></a></li>
            @endcan
            @can('subjects.index')
                <li class="{{ setActive('admin/subject') }}"><a class="nav-link"
                        href="{{ route('admin.subject.index') }}"><i class="fas fa-book"></i>
                        <span>Subjects</span></a></li>
            @endcan
            @if (auth()->user()->can('photos.index') ||
                    auth()->user()->can('videos.index') ||
                    auth()->user()->can('sliders.index'))
                <li class="menu-header">Galeri</li>
                <li class="nav-item dropdown {{ setActive('admin/foto') }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                            class="fas fa-columns"></i>
                        <span>Gallery</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ setActive('admin/foto') }}">
                            <a class="nav-link" href="{{ route('admin.photo.index') }}"><i class="fas fa-camera"></i>
                                Photos</a>
                        </li>
                        <li class="{{ setActive('admin/video') }}">
                            <a class="nav-link" href="{{ route('admin.video.index') }}"><i class="fas fa-video"></i>
                                Videos</a>
                        </li>
                        <li class="{{ setActive('admin/slider') }}">
                            <a class="nav-link" href="{{ route('admin.slider.index') }}"><i
                                    class="far fa-file-image"></i>
                                Sliders</a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (auth()->user()->can('profiles.index') ||
                    auth()->user()->can('academicachievments.index'))
                <li class="menu-header">Settings</li>
                <li class="{{ setActive('admin/profile') }}">
                    <a class="nav-link" href="{{ route('admin.profile.index') }}"><i class="fas fa-id-badge"></i>
                        Profile</a>
                </li>
            @endif
            @if (auth()->user()->can('roles.index') ||
                    auth()->user()->can('permissions.index') ||
                    auth()->user()->can('users.index'))
                <li class="menu-header">Configuration</li>
            @endif
            <li
                class="nav-item dropdown {{ setActive('admin/role') . setActive('admin/permission') . setActive('admin/user') }}">
                @if (auth()->user()->can('roles.index') ||
                        auth()->user()->can('permissions.index') ||
                        auth()->user()->can('users.index'))
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-user-cog"></i>
                        <span>User Management</span></a>
                @endif
                <ul class="dropdown-menu">
                    @can('roles.index')
                        <li class="{{ setActive('admin/role') }}">
                            <a class="nav-link" href="{{ route('admin.role.index') }}"><i class="fas fa-id-badge"></i>
                                Roles</a>
                        </li>
                    @endcan
                    @can('permissions.index')
                        <li class="{{ setActive('admin/permission') }}">
                            <a class="nav-link" href="{{ route('admin.permission.index') }}"><i
                                    class="fas fa-user-check"></i> Permissions</a>
                        </li>
                    @endcan
                    @if ('user.index')
                        <li class="{{ setActive('admin/user') }}">
                            <a class="nav-link" href="{{ route('admin.user.index') }}"><i
                                    class="fas fa-user-friends"></i> Users</a>
                        </li>
                    @endif
                </ul>
            </li>

        </ul>
    </aside>
</div>
