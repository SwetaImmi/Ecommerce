   <!-- partial -->
   <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin')}}">
              <i class="ti-shield menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/products_list">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Product Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/gallery_list">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Product Gallery Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/banner_list">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Banner Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/plan_list">
              <i class="ti-view-list-alt menu-icon"></i>
              <span class="menu-title">Subscription plan Tables</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/category">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Add categories</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/products">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Add Products</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/gallery">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Add Products Gallery</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/admin/banner">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Add Banner</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('/admin/create_subscription')}}">
              <i class="ti-pie-chart menu-icon"></i>
              <span class="menu-title">Add Subscription Plan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="login"> Login </a></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="assets/pages/samples/login-2.html"> Login 2 </a></li> -->
                <li class="nav-item"> <a class="nav-link" href="/admin/register"> Register </a></li>
                <!-- <li class="nav-item"> <a class="nav-link" href="assets/pages/samples/register-2.html"> Register 2 </a></li> -->
                <!-- <li class="nav-item"> <a class="nav-link" href="assets/pages/samples/lock-screen.html"> Lockscreen </a></li> -->
              </ul>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="assets/documentation/documentation.html">
              <i class="ti-write menu-icon"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- partial -->