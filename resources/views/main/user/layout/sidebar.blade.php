
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-heading">Pages</li>

      <li class="nav-item dashboard">
        <a class="nav-link @if (url()->current()!=route('user#myDashboard') && url()->current()!=route('user#report') ) collapsed @endif" data-bs-target="#dashboard" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Dashboard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dashboard" class="nav-content @if (url()->current()!=route('user#myDashboard') && url()->current()!=route('user#report') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user#myDashboard')}}">
              <i class="bi bi-circle"></i><span>My Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{route('user#report')}}">
              <i class="bi bi-circle"></i><span>Report</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item profile">
        <a class="nav-link @if (url()->current()!=route('user#profile')) collapsed @endif" href="{{route('user#profile')}}">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li>

      <li class="nav-item admin">
        <a class="nav-link @if (url()->current()!=route('user#adminList')) collapsed @endif" data-bs-target="#admin" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="admin" class="nav-content  @if (url()->current()!=route('user#adminList')) collapse @endif " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user#adminList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item category">
        <a class="nav-link @if (url()->current()!=route('user#categoryList') && url()->current()!=route('user#categoryAddPage') ) collapsed @endif" data-bs-target="#category" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="category" class="nav-content   @if (url()->current()!=route('user#categoryList') && url()->current()!=route('user#categoryAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user#categoryList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('user#categoryAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item brand">
        <a class="nav-link @if (url()->current()!=route('user#brandList') && url()->current()!=route('user#brandAddPage') ) collapsed @endif" data-bs-target="#brand" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Brand</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="brand" class="nav-content   @if (url()->current()!=route('user#brandList') && url()->current()!=route('user#brandAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user#brandList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('user#brandAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      @if (Auth::user()->position!='supplier')
        <li class="nav-item product">
            <a class="nav-link @if (url()->current()!=route('user#productList') && url()->current()!=route('user#productAddPage') ) collapsed @endif" data-bs-target="#product" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="product" class="nav-content   @if (url()->current()!=route('user#productList') && url()->current()!=route('user#productAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('user#productList')}}">
                <i class="bi bi-circle"></i><span>List</span>
                </a>
            </li>
            <li>
                <a href="{{route('user#productAddPage')}}">
                <i class="bi bi-circle"></i><span>Add</span>
                </a>
            </li>
            </ul>
        </li>

        <li class="nav-item order">
            <a class="nav-link @if (url()->current()!=route('seller#listOrder')) collapsed @endif" data-bs-target="#order" data-bs-toggle="collapse" href="#">
              <i class="bi bi-journal-text"></i><span>Order</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="order" class="nav-content @if (url()->current()!=route('seller#listOrder')) collapse @endif  " data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{route('seller#listOrder')}}">
                  <i class="bi bi-circle"></i><span>List</span>
                </a>
              </li>
            </ul>
          </li>
      @endif

      @if (Auth::user()->position=='supplier')
        <li class="nav-item supplier">
            <a class="nav-link @if (url()->current()!=route('user#supplier_productList') && url()->current()!=route('user#supplier_productAddPage') ) collapsed @endif" data-bs-target="#supplier" data-bs-toggle="collapse" href="#">
            <i class="bi bi-journal-text"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="supplier" class="nav-content   @if (url()->current()!=route('user#supplier_productList') && url()->current()!=route('user#supplier_productAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('user#supplier_productList')}}">
                <i class="bi bi-circle"></i><span>Product List</span>
                </a>
            </li>
            <li>
                <a href="{{route('user#supplier_productAddPage')}}">
                <i class="bi bi-circle"></i><span>Add Product</span>
                </a>
            </li>
            </ul>
        </li>
      @endif

      <li class="nav-item payment">
        <a class="nav-link @if (url()->current()!=route('user#paymentList') && url()->current()!=route('user#paymentAddPage') ) collapsed @endif" data-bs-target="#payment" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Payment</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="payment" class="nav-content @if (url()->current()!=route('user#paymentList') && url()->current()!=route('user#paymentAddPage') ) collapse @endif  " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{route('user#paymentList')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
          <li>
            <a href="{{route('user#paymentAddPage')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="nav-item purchase">
        <a class="nav-link @if (url()->current()!=route('user#supplierList') && url()->current()!=route('user#listPurchase') && url()->current() != route('supplier#listPurchase') ) collapsed @endif" data-bs-target="#purchase" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Purchase</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="purchase" class="nav-content @if (url()->current()!=route('user#supplierList') && url()->current()!=route('user#listPurchase') && url()->current() != route('supplier#listPurchase') ) collapse @endif " data-bs-parent="#sidebar-nav">
          @if (Auth::user()->position!='supplier')
            <li>
                <a href="{{route('user#supplierList')}}">
                <i class="bi bi-circle"></i><span>Supplier List</span>
                </a>
            </li>
            <li>
                <a href="{{route('user#listPurchase')}}">
                  <i class="bi bi-circle"></i><span>History</span>
                </a>
            </li>
          @else
            <li>
                <a href="{{route('supplier#listPurchase')}}">
                    <i class="bi bi-circle"></i><span>List</span>
                </a>
            </li>
          @endif

        </ul>
      </li>

      <li class="nav-item message">
        <a class="nav-link @if (url()->current()!=route('user#messageAddPage') && url()->current()!=route('user#messageList','inbox') && url()->current()!=route('user#messageList','send') && url()->current()!=route('user#messageList','report')) collapsed @endif" data-bs-target="#message" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Message</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="message" class="nav-content @if (url()->current()!=route('user#messageAddPage') && url()->current()!=route('user#messageList','inbox') && url()->current()!=route('user#messageList','send') && url()->current()!=route('user#messageList','report')) collapse @endif" data-bs-parent="#sidebar-nav">
            <li>
                <a href="{{route('user#messageAddPage')}}">
                  <i class="bi bi-circle"></i><span>New Mail</span>
                </a>
              </li>
            <li>
            <a href="{{route('user#messageList','inbox')}}">
              <i class="bi bi-circle"></i><span>Inbox</span>
            </a>
          </li>
          <li>
            <a href="{{route('user#messageList','send')}}">
              <i class="bi bi-circle"></i><span>Send Item</span>
            </a>
          </li>
        </ul>
      </li>

    </ul>

  </aside><!-- End Sidebar-->
