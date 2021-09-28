<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
        $permission = Auth::guard('administration')->user();
    ?>
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/')}}assets/backend/admin/dist/img/logo.webp" alt="AleshaMart" class="brand-image">
        <span class="brand-text font-weight-light">AleshaMart Panel</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar" style="margin-bottom: 20px;">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('/')}}assets/backend/admin/dist/img/admin.png" class="img-circle elevation-2" alt="Admin">
            </div>
            <div class="info">
                <a href="#" class="d-block">
                    {{ Auth::guard('administration')->user()->fullname }}
                </a>
            </div>
        </div>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                     <li class="nav-item">
                         <a href="{{ route('admin.dashboard') }}" class="nav-link">
                             <i class="nav-icon fas fa-th"></i>
                             <p>Dashboard</p>
                         </a>
                     </li>

                    @if($permission->can('admin.view') || $permission->can('group.view') || $permission->can('roles.view') || 
                    $permission->can('permission.view') || $permission->can('notification.view') || $permission->can('support.view'))
                    <li class="sidenav-heading">Management Modules</li>
                    @endif
                    @if($permission->can('admin.create') || $permission->can('admin.view') || $permission->can('admin.edit') || $permission->can('admin.delete'))
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                             <i class="nav-icon fas fa-tachometer-alt"></i>
                             <p>
                                 Admin
                                 <i class="right fas fa-angle-left"></i>
                             </p>
                         </a>
                         <ul class="nav nav-treeview">
                             @if($permission->can('admin.view'))
                             <li class="nav-item">
                                 <a href="{{ route('admins.index')}}" class="nav-link">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Admin List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('admin.create'))
                             <li class="nav-item">
                                 <a href="{{ route('admins.create')}}" class="nav-link">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Admin</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                   
                    @if($permission->can('roles.create') || $permission->can('roles.view') || $permission->can('roles.edit') || $permission->can('roles.delete'))
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                             Role
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview">
                             @if($permission->can('roles.view'))
                             <li class="nav-item">
                                 <a href="{{ route('role.index')}}" class="nav-link">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Role List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('roles.create'))
                             <li class="nav-item">
                                 <a href="{{ route('role.create')}}" class="nav-link">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Role</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                    @if($permission->can('permission.create') || $permission->can('permission.view') || $permission->can('permission.edit') || 
                    $permission->can('permission.delete'))
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                             Permission
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview">
                             @if($permission->can('permission.view'))
                             <li class="nav-item">
                                 <a href="{{ route('permission.index')}}" class="nav-link">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Permission List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('permission.create'))
                             <li class="nav-item">
                                 <a href="{{ route('permission.create')}}" class="nav-link">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>New Permission</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                    
                    @if($permission->can('comProfile.view') || $permission->can('comProfile.edit') || $permission->can('comProfile.delete'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Company Profile
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($permission->can('comProfile.view'))
                            <li class="nav-item">
                                <a href="{{ route('companyprofile.index')}}" class="nav-link">
                                    <i class="fa fa-bars nav-icon"></i>
                                    <p>Company Profile List</p>
                                </a>
                            </li>
                            @endif
                        </ul>
    
                    </li>
                    @endif
                    
                    {{-- Base Modules  --}}
                    @if($permission->can('customer.create') || $permission->can('customer.view') || $permission->can('customer.edit') || $permission->can('customer.delete'))
                    <li class="sidenav-heading">Base Modules</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customer
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>New Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Old Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Social Media Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Telephonic Customer List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('customer.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Customer</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Leads
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Leads List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Active Leads List</p>
                                </a>
                            </li>
                        @endif
                                                
                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('customer.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Leads</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Contacts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>All Contacts List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('customer.view'))
                            <li class="nav-item">
                                <a href="{{ route('customer.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Active Contacts List</p>
                                </a>
                            </li>
                        @endif
                                                
                        @if($permission->can('customer.create'))
                            <li class="nav-item">
                                <a href="{{ route('customer.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Contacts</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    @endif
                    
                    {{-- Marketing Modules  --}}
                    <li class="sidenav-heading">Marketing Modules</li>
                    @if($permission->can('notification.create') || $permission->can('notification.view') || $permission->can('notification.edit') || $permission->can('notification.delete') || $permission->can('notification.type') || $permission->can('notification.userType'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-genderless"></i>
                        <p>
                            Email Marketing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($permission->can('notification.view'))
                            <li class="nav-item">
                                <a href="{{ route('notification.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Email List</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.create'))
                            <li class="nav-item">
                                <a href="{{ route('admin.create.notification')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Send New Email</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('notification.type')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Email Template Type</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('notification.type')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Email Templates</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    
                    @if($permission->can('notification.create') || $permission->can('notification.view') || $permission->can('notification.edit') || 
                    $permission->can('notification.delete') || $permission->can('notification.type') || $permission->can('notification.userType'))
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-genderless"></i>
                        <p>
                            SMS Marketing
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @if($permission->can('notification.view'))
                            <li class="nav-item">
                                <a href="{{ route('notification.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Sent SMS List</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.create'))
                            <li class="nav-item">
                                <a href="{{ route('admin.create.notification')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Send New SMS</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('notification.type')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>SMS Template Type</p>
                                </a>
                            </li>
                            @endif
                            @if($permission->can('notification.type'))
                            <li class="nav-item">
                                <a href="{{ route('notification.template')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>SMS Templates</p>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    @endif
                    
                    @if($permission->can('support.compose') || $permission->can('support.inbox') || $permission->can('support.sentmail') || $permission->can('support.draftmail'))
                     <li class="nav-item">
                         <a href="#" class="nav-link">
                           <i class="nav-icon fa fa-genderless"></i>
                           <p>
                             Ticketing/Support
                             <i class="right fas fa-angle-left"></i>
                           </p>
                         </a>
                         <ul class="nav nav-treeview">
                             @if($permission->can('support.compose'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.newmail')}}" class="nav-link">
                                 <i class="fa fa-plus nav-icon"></i>
                                 <p>Create New Ticket</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.inbox'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.mailbox')}}" class="nav-link">
                                 <i class="fa fa-bars nav-icon"></i>
                                 <p>Ticke List</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.sentmail'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.sentmail')}}" class="nav-link">
                                 <i class="fa fa-envelope nav-icon"></i>
                                 <p>Sent Ticket</p>
                                 </a>
                             </li>
                             @endif
                             @if($permission->can('support.draftmail'))
                             <li class="nav-item">
                                 <a href="{{ route('admin.draftmail')}}" class="nav-link">
                                 <i class="fa fa-envelope nav-icon"></i>
                                 <p>Draft Ticket</p>
                                 </a>
                             </li>
                             @endif
                         </ul>
                     </li>
                    @endif
                    @if($permission->can('news.create') || $permission->can('news.view') || $permission->can('news.edit') || $permission->can('news.delete'))
                   	 <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-newspaper"></i>
                        <p>
                            News
                            <i class="right fas fa-angle-left"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        @if($permission->can('news.view'))
                            <li class="nav-item">
                                <a href="{{ route('news.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>News List</p>
                                </a>
                            </li>
                        @endif
                        @if($permission->can('news.create'))
                            <li class="nav-item">
                                <a href="{{ route('news.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New News</p>
                                </a>
                            </li>
                        @endif
                        </ul>
                    </li>
                    @endif

                
                               
                <li class="sidenav-heading">Sales Modules</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Campaign
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('campaign.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Campaign List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign.active')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Active Campaign</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Campaign</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Sub Campaign
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Sub Campaign List</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>New Sub Campaign</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Accounts
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Income Head</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Expense Head</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Income Entry</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Expense Entry</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Balance Sheet</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-list"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.index')}}" class="nav-link">
                                <i class="fa fa-bars nav-icon"></i>
                                <p>Accounts Reports</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Sale Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Order Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Campaign Wise Order Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('campaign_sub.create')}}" class="nav-link">
                                <i class="fa fa-plus nav-icon"></i>
                                <p>Campaign Wise Income Reports</p>
                            </a>
                        </li>
                    </ul>
                </li>                                
            </ul>
        </nav>


        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
