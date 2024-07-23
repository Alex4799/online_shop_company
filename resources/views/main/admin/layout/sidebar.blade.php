
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Pages</li>

      <li class="nav-item dashboard">
        <a class="nav-link @if (url()->current()!=route('admin#dashboard') && url()->current()!=route('admin#report') ) collapsed @endif" data-bs-target="#dashboard" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dashboard" class="nav-content   @if (url()->current()!=route('admin#dashboard') && url()->current()!=route('admin#report') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#dashboard')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#report')}}">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item profile">
        <a class="nav-link @if (url()->current()!=route('admin#profile')) collapsed @endif" href="{{route('admin#profile')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item admin">
        <a class="nav-link @if (url()->current()!=route('admin#list') && url()->current()!=route('admin#addPage') ) collapsed @endif" data-bs-target="#admin" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin" class="nav-content  @if (url()->current()!=route('admin#list') && url()->current()!=route('admin#addPage') ) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#list')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#addPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item user">
        <a class="nav-link @if (url()->current()!=route('admin#userList') && url()->current()!=route('admin#userAddPage') ) collapsed @endif" data-bs-target="#user" data-bs-toggle="collapse" href="#">
            <i class="bi bi-person"></i><span>User</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="user" class="nav-content  @if (url()->current()!=route('admin#userList') && url()->current()!=route('admin#userAddPage') ) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#userList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#userAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item category">
        <a class="nav-link @if (url()->current()!=route('admin#categoryList') && url()->current()!=route('admin#categoryAddPage') ) collapsed @endif" data-bs-target="#category" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="category" class="nav-content   @if (url()->current()!=route('admin#categoryList') && url()->current()!=route('admin#categoryAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#categoryList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#categoryAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item brand">
        <a class="nav-link @if (url()->current()!=route('admin#brandList') && url()->current()!=route('admin#brandAddPage') ) collapsed @endif" data-bs-target="#brand" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Brand</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="brand" class="nav-content   @if (url()->current()!=route('admin#brandList') && url()->current()!=route('admin#brandAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#brandList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#brandAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item supplier">
        <a class="nav-link @if (url()->current()!=route('admin#supplierList') ) collapsed @endif" data-bs-target="#supplier" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="supplier" class="nav-content   @if (url()->current()!=route('admin#supplierList') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#supplierList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#supplier_productList')}}">
            <i class="bi bi-circle"></i><span>Product List</span>
            </a>
        </li>
        </ul>
      </li>

      <li class="nav-item product">
        <a class="nav-link @if (url()->current()!=route('admin#productList') && url()->current()!=route('admin#productAddPage') ) collapsed @endif" data-bs-target="#product" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="product" class="nav-content   @if (url()->current()!=route('admin#productList') && url()->current()!=route('admin#productAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#productList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#productAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link @if (url()->current()!=route('admin#orderList') ) collapsed @endif" data-bs-target="#order" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="order" class="nav-content @if (url()->current()!=route('admin#orderList') ) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#orderList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link @if (url()->current()!=route('admin#listPurchase') ) collapsed @endif" data-bs-target="#purchase" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Purchase</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="purchase" class="nav-content @if (url()->current()!=route('admin#listPurchase') ) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('admin#listPurchase')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item message">
        <a class="nav-link @if (url()->current()!=route('admin#messageAddPage') && url()->current()!=route('admin#messageList','inbox') && url()->current()!=route('admin#messageList','send') && url()->current()!=route('admin#messageList','report')) collapsed @endif" data-bs-target="#message" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Message</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="message" class="nav-content @if (url()->current()!=route('admin#messageAddPage') && url()->current()!=route('admin#messageList','inbox') && url()->current()!=route('admin#messageList','send') && url()->current()!=route('admin#messageList','report')) collapse @endif" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('admin#messageAddPage')}}">
                  <i class="bi bi-circle"></i><span>New Mail</span>
                </a>
              </li>
            <li>
            <a href="{{route('admin#messageList','inbox')}}">
              <i class="bi bi-circle"></i><span>Inbox</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#messageList','send')}}">
              <i class="bi bi-circle"></i><span>Send Item</span>
            </a>
          </li>
          <li>
            <a href="{{route('admin#messageList','report')}}">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item">
        <a class="nav-link @if (url()->current()!=route('admin#editInterface')) collapsed @endif" href="{{route('admin#editInterface')}}">
          <i class="bi bi-journal-text"></i>
          <span>Interface</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
