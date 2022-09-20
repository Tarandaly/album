<nav class="navbar navbar-expand-lg navbar-top navbar-fixed navbar-opaque" color-on-scroll="10">
  <div class="container">
    <a class="navbar-brand" href="/">
      <img src="/img/logo-placeholder.png" class="light" style="width: 165px;">
    </a>
    <a class="navbar-toggle order-4 popup-inline"
      href="#navbar-mobile-style-1"><span></span><span></span><span></span>
    </a>
    <ul class="nav navbar-nav order-2 ms-auto nav-no-opacity">
      @if (Route::has('login'))
        @auth
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-none">
              @csrf
            </form>
            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();this.previousElementSibling.submit();">
              <span>{{ __('Log Out') }}</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/dashboard') }}">
              <span>Dashboard</span>
            </a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">
              <span>Log in</span>
            </a>
          </li>
          @if (Route::has('register'))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">
                <span>Sign up</span>
              </a>
            </li>
          @endif
        @endauth
      @endif
    </ul>
    <a
      class="btn d-none d-sm-inline-flex btn btn-sm btn-accent-1 ms-auto ms-lg-60 me-30 me-lg-0 order-2 order-lg-3"
      href="#" target="_blank">Contact Us</a>
  </div>
</nav>

{{-- mobile nav->>>>>>>> --}}
<div class="navbar navbar-mobile navbar-mobile-style-1 bg-white mfp-hide" id="navbar-mobile-style-1">
  <div class="navbar-wrapper">
    <div class="navbar-head">
      <a class="navbar-brand d-block d-md-none" href="/">
        <img src="/img/logo-placeholder.png" class="light" style="width: 165px;">
      </a>
      <a class="navbar-toggle popup-modal-dismiss" href="#"><span></span><span></span><span></span></a>
    </div>
    <div class="navbar-body">
      
    </div>
    <div class="navbar-footer">
      <!-- Contacts-->
      <ul class="list-group borderless font-size-15">
        <li class="list-group-item">Email: <a href="mailto:tarandaly@gamil.com">tarandaly@gamil.com</a></li>
        <li class="list-group-item">Phone: <a href="tel:+201012345678">+20 101 234 5678</a></li>
      </ul><!-- Social-->
      <ul class="nav nav-gap-sm navbar-nav nav-social mt-30 nav-no-opacity">
        <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="8"
              height="15" fill="none">
              <path fill="currentColor"
                d="M5.93 3.08h1.128V.974A13.651 13.651 0 0 0 5.416.882c-1.626 0-2.74 1.096-2.74 3.11v1.853H.882v2.353h1.794v5.92h2.2v-5.92h1.721l.274-2.353H4.875v-1.62c0-.68.171-1.146 1.056-1.146Z" />
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="17"
              height="13" fill="none">
              <path fill="currentColor"
                d="M16.409 2.635a2.004 2.004 0 0 0-1.405-1.423c-1.24-.337-6.21-.337-6.21-.337s-4.971 0-6.21.337a2.004 2.004 0 0 0-1.406 1.423C.846 3.891.846 6.511.846 6.511s0 2.62.332 3.876a1.974 1.974 0 0 0 1.405 1.402c1.24.336 6.21.336 6.21.336s4.971 0 6.21-.336a1.974 1.974 0 0 0 1.406-1.402c.332-1.255.332-3.876.332-3.876s0-2.62-.332-3.876ZM7.168 8.89V4.132l4.154 2.38L7.168 8.89Z" />
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
              height="13" fill="none">
              <path fill="currentColor"
                d="M13.986 3.445c.01.133.01.266.01.4 0 4.064-3.093 8.746-8.747 8.746a8.687 8.687 0 0 1-4.72-1.38c.247.029.485.038.742.038 1.437 0 2.76-.485 3.816-1.313a3.08 3.08 0 0 1-2.874-2.132 3.251 3.251 0 0 0 1.39-.057A3.075 3.075 0 0 1 1.137 4.73v-.038c.41.228.886.37 1.39.39a3.072 3.072 0 0 1-1.37-2.56c0-.571.152-1.095.418-1.552a8.738 8.738 0 0 0 6.34 3.217 3.47 3.47 0 0 1-.077-.704A3.073 3.073 0 0 1 10.912.409c.885 0 1.685.37 2.246.97A6.052 6.052 0 0 0 15.11.637a3.066 3.066 0 0 1-1.352 1.694 6.164 6.164 0 0 0 1.77-.476 6.609 6.609 0 0 1-1.542 1.59Z" />
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="15"
              height="15" fill="none">
              <path fill="currentColor"
                d="M7.504 4.13c-1.88 0-3.395 1.504-3.395 3.367s1.516 3.366 3.395 3.366 3.394-1.503 3.394-3.366c0-1.863-1.515-3.366-3.394-3.366Zm0 5.556a2.202 2.202 0 0 1-2.207-2.189A2.2 2.2 0 0 1 7.504 5.31 2.2 2.2 0 0 1 9.71 7.497a2.202 2.202 0 0 1-2.207 2.189Zm4.325-5.693a.787.787 0 0 1-.792.785.787.787 0 0 1-.792-.785c0-.433.355-.785.792-.785.437 0 .792.352.792.785Zm2.248.797c-.05-1.052-.293-1.983-1.07-2.75-.774-.769-1.713-1.009-2.774-1.061C9.14.917 5.864.917 4.771.979c-1.058.05-1.997.29-2.774 1.057-.777.768-1.016 1.7-1.07 2.751-.062 1.084-.062 4.333 0 5.417.05 1.052.293 1.983 1.07 2.751.777.768 1.713 1.008 2.774 1.06 1.093.062 4.37.062 5.462 0 1.061-.05 2-.29 2.775-1.06.774-.768 1.016-1.7 1.069-2.75.062-1.085.062-4.331 0-5.415Zm-1.412 6.577a2.225 2.225 0 0 1-1.259 1.248c-.871.343-2.94.264-3.902.264-.963 0-3.034.076-3.903-.264a2.225 2.225 0 0 1-1.259-1.248c-.345-.864-.265-2.915-.265-3.87 0-.955-.077-3.009.265-3.87a2.225 2.225 0 0 1 1.259-1.248c.872-.343 2.94-.264 3.903-.264.963 0 3.034-.076 3.902.264.58.228 1.025.67 1.259 1.248.346.864.266 2.915.266 3.87 0 .955.08 3.009-.266 3.87Z" />
            </svg></a></li>
        <li class="nav-item"><a class="nav-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16"
              height="13" fill="none">
              <path fill="currentColor"
                d="M2.565 3.169a.553.553 0 0 0-.178-.463L1.065 1.112V.875h4.108l3.176 6.964L11.14.875h3.917v.237l-1.131 1.084a.33.33 0 0 0-.126.317v7.968a.33.33 0 0 0 .126.317l1.104 1.084v.237H9.474v-.237l1.145-1.11c.111-.112.111-.147.111-.317v-6.44L7.546 12.1h-.43L3.411 4.016v5.417a.738.738 0 0 0 .205.62l1.488 1.805v.238H.887v-.235l1.488-1.807a.714.714 0 0 0 .19-.621V3.169Z" />
            </svg></a></li>
      </ul>
    </div>
  </div>
</div>