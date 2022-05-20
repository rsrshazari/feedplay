<?php $userDetails=getUserDetails($userId); ?>
<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
  <div class="ms-md-auto pe-md-3 d-flex align-items-center">
    <!-- <div class="input-group">
      <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
      <input type="text" class="form-control" placeholder="Type here...">
    </div> -->
  </div>
  <ul class="navbar-nav  justify-content-end">

      <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-white pe-3" id="iconNavbarSidenav">
          <div class="sidenav-toggler-inner">
            <i class="sidenav-toggler-line bg-white"></i>
            <i class="sidenav-toggler-line bg-white"></i>
            <i class="sidenav-toggler-line bg-white"></i>
          </div>
        </a>
      </li>
      <li class="nav-item dropdown pe-3 d-flex align-items-center">
        <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="ni ni-bell-55"></i>
        </a>
        <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
          <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="javascript:;">
              <div class="d-flex py-1">
                <div class="my-auto">
                  <img src="../assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-1">
                    <span class="font-weight-bold">New message</span> from Laur
                  </h6>
                  <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    13 minutes ago
                  </p>
                </div>
              </div>
            </a>
          </li>
          <li class="mb-2">
            <a class="dropdown-item border-radius-md" href="javascript:;">
              <div class="d-flex py-1">
                <div class="my-auto">
                  <img src="../assets/img/small-logos/logo-spotify.svg" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-1">
                    <span class="font-weight-bold">New album</span> by Travis Scott
                  </h6>
                  <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    1 day
                  </p>
                </div>
              </div>
            </a>
          </li>
          <li>
            <a class="dropdown-item border-radius-md" href="javascript:;">
              <div class="d-flex py-1">
                <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                  <svg width="12px" height="12px" viewBox="0 0 43 36" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>credit-card</title>
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g transform="translate(-2169.000000, -745.000000)" fill="#FFFFFF" fill-rule="nonzero">
                        <g transform="translate(1716.000000, 291.000000)">
                          <g transform="translate(453.000000, 454.000000)">
                            <path class="color-background" d="M43,10.7482083 L43,3.58333333 C43,1.60354167 41.3964583,0 39.4166667,0 L3.58333333,0 C1.60354167,0 0,1.60354167 0,3.58333333 L0,10.7482083 L43,10.7482083 Z" opacity="0.593633743"></path>
                            <path class="color-background" d="M0,16.125 L0,32.25 C0,34.2297917 1.60354167,35.8333333 3.58333333,35.8333333 L39.4166667,35.8333333 C41.3964583,35.8333333 43,34.2297917 43,32.25 L43,16.125 L0,16.125 Z M19.7083333,26.875 L7.16666667,26.875 L7.16666667,23.2916667 L19.7083333,23.2916667 L19.7083333,26.875 Z M35.8333333,26.875 L28.6666667,26.875 L28.6666667,23.2916667 L35.8333333,23.2916667 L35.8333333,26.875 Z"></path>
                          </g>
                        </g>
                      </g>
                    </g>
                  </svg>
                </div>
                <div class="d-flex flex-column justify-content-center">
                  <h6 class="text-sm font-weight-normal mb-1">
                    Payment successfully completed
                  </h6>
                  <p class="text-xs text-secondary mb-0">
                    <i class="fa fa-clock me-1"></i>
                    2 days
                  </p>
                </div>
              </div>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item dropdown pe-2 d-flex align-items-center">
        <a class="nav-link pr-0" href="#" role="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
          <div class="media align-items-center">
            <span class="avatar avatar-sm rounded-circle">
              <?php if ($userDetails['photo']==''){ ?>
                    <img alt="Image placeholder" src="assets1/img/user/1.png">
              <?php }else{ ?>
            <img alt="Image placeholder" src="assets1/img/user/<?=$userDetails['photo']?>">
          <?php } ?>
            </span>
            <div class="media-body ml-2  d-none d-lg-block">
              <span class="mb-0 text-sm  font-weight-bold text-white"><?=$userDetails['name']?></span>
            </div>
          </div>
        </a>
        <div class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton2">
          <div class="dropdown-header noti-title">
            <h6 class="text-overflow m-0">Welcome! <?=$userDetails['name']?></h6>
          </div>
          <a href="profile.php" class="dropdown-item">
            <i class="ni ni-single-02"></i>
            <span>My profile</span>
          </a>
          <a href="setting.php" class="dropdown-item">
            <i class="ni ni-settings-gear-65"></i>
            <span>Settings</span>
          </a>

          <div class="dropdown-divider"></div>
          <a href="logout.php" class="dropdown-item">
            <i class="ni ni-user-run"></i>
            <span>Logout</span>
          </a>
        </div>
      </li>
    </ul>
</div>
