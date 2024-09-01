  <!-- Nav Sidebar -->
  <nav class="sidebar offcanvas-md offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false"
      style="max-height: 100vh; overflow-y: auto;">
      <div class="d-flex justify-content-end m-3 d-block d-md-none">
          <button aria-label="Close" data-bs-dismiss="offcanvas" data-bs-target=".sidebar" class="btn p-0 border-0 fs-4">
              <i class="fas fa-close"></i>
          </button>
      </div>
      <div class="d-flex justify-content-center mt-md-5 mb-5">
          <img src="{{ asset('assets') }}/images/logo.svg" alt="Logo" width="140px" height="40px" />
      </div>
      <div class="pt-2 d-flex flex-column gap-5">
          <div class="menu p-0">
              <p>Daily Use</p>
              <a href="{{ route('dashboard') }}" class="item-menu active">
                  <i class="icon ic-stats"></i>
                  Overview
              </a>
              <a href="{{ route('admin.registration.index') }}" class="item-menu">
                  <i class="icon ic-trans"></i>
                  Transactions
              </a>
              <a href="#" class="item-menu">
                  <i class="icon ic-msg"></i>
                  Messages
              </a>
              <a href="{{ route('admin.event.index') }}" class="item-menu">
                  <i class="icon ic-stats"></i>
                  Events
              </a>
              <a href="{{ route('admin.ticket.index') }}" class="item-menu">
                  <i class="icon ic-account"></i>
                  Tickets
              </a>
              @role('admin')
              <a href="{{ route('admin.organizer.index') }}" class="item-menu">
                  <i class="icon ic-account"></i>
                  Organizer
              </a>
              <a href="#" class="item-menu">
                  <i class="icon ic-account"></i>
                  User
              </a>
              @endrole
          </div>
          <div class="menu">
              <p>Others</p>
              <a href="#" class="item-menu">
                  <i class="icon ic-settings"></i>
                  Settings
              </a>
              <a href="#" class="item-menu">
                  <i class="icon ic-help"></i>
                  Help
              </a>

              <a href="#" class="item-menu">
                  <!-- Authentication -->
                  <form method="POST" class="border-0"  action="{{ route('logout') }}" >
                      @csrf
                      <button ><i class="icon ic-logout"></i>
                        Logout</button>
                  </form>
              </a>


          </div>
      </div>
  </nav>
