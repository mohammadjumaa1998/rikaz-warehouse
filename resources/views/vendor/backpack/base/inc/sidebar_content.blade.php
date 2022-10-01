<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('group') }}"><i class="nav-icon la la-question"></i> Groups</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('item') }}"><i class="nav-icon la la-question"></i> Items</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('customer') }}"><i class="nav-icon la la-question"></i> Customers</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('supplier') }}"><i class="nav-icon la la-question"></i> Suppliers</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('export') }}"><i class="nav-icon la la-question"></i> Exports</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('emport') }}"><i class="nav-icon la la-question"></i> Emports</a></li>
<!-- Users, Roles, Permissions -->
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> Authentication</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>Users</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>Roles</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>Permissions</span></a></li>
    </ul>
</li>