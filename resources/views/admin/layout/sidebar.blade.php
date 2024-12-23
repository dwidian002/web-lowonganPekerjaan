<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
  <div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand m-0" href="{{route('home')}}" target="_blank">
      <img src="{{ asset('assets/img/wonderwoman.jpg') }}" class="navbar-brand-img h-100" alt="main_logo" >
      <span class="ms-1 font-weight-bold">WonderWoman Job</span>
    </a>
  </div>
  <hr class="horizontal dark mt-0">
  <div class="  w-auto " id="sidenav-collapse-main">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link active" href="./pages/dashboard.html">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
          </div>
          <span class="nav-link-text ms-1">Dashboard</span>
        </a>
      </li>
      <li class="nav">
        <a class="nav-link active" href="{{route('location.index')}}">
          <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fa fa-map-marker text-danger text-sm opacity-10 "></i>
          </div>
          <span class="nav-link-text">Location</span>
        </a>
      </li>
      <ul class="nav">
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#user-collapse" aria-expanded="false">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-building text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text">Company</span>
          </a>
          <div class="collapse" id="user-collapse">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{route('company.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> B </span>
                  <span class="sidenav-normal"> Account of Company </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('industry.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> D </span>
                  <span class="sidenav-normal"> Industry </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('type-company.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> F </span>
                  <span class="sidenav-normal"> type Company </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="nav">
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#job-collapse" aria-expanded="false">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-briefcase text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text">Job</span>
          </a>
          <div class="collapse" id="job-collapse">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{route ('all-job')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> C </span>
                  <span class="sidenav-normal"> Job Postings </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> E </span>
                  <span class="sidenav-normal"> Job Category </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('field-work.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> E </span>
                  <span class="sidenav-normal"> Field Of Work </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <ul class="nav">
        <li class="nav-item">
          <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#applicant-collapse" aria-expanded="false">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa fa-users text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text">Applicant</span>
          </a>
          <div class="collapse" id="applicant-collapse">
            <ul class="nav nav-sm flex-column">
              <li class="nav-item">
                <a href="{{route('applicant.index')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> C </span>
                  <span class="sidenav-normal"> Applicant Account </span>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('application.list')}}" class="nav-link">
                  <span class="sidenav-mini-icon"> E </span>
                  <span class="sidenav-normal"> Application </span>
                </a>
              </li>
            </ul>
          </div>
        </li>
      </ul>
      <li class="nav-item mt-3">
        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
      </li>
      <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}">
            @csrf
        </form>
        <a class="nav-link" href="#" onclick="confirmLogout()">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Logout</span>
        </a>
    </li>
    </ul>
  </div>
</aside>