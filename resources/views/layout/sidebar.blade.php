<div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php if($state=='dashboard'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('dashboard')}}">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='tiket'){echo 'active';} ?>">
            <a class="<?php if($state=='tiket'){echo 'nav-link';}else{echo 'dropdown-btn';} ?>" href="#">
              <i class="material-icons">post_add</i>
                <p>Tiket</p>
            </a>        
            <ul class="<?php if($state=='tiket'){echo 'nav';}else{echo 'dropdown-container';} ?>" >
              <a class="nav-link" href="#" data-toggle="tab"><span class="material-icons">narrow_right</span> Open</a>
              <a class="nav-link" href="#" data-toggle="tab"><span class="material-icons">narrow_right</span> Assigned</a>
              <a class="nav-link" href="#" data-toggle="tab"><span class="material-icons">narrow_right</span> Closed</a>
            </ul>
          </li>
          <li class="nav-item <?php if($state=='kategori'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('kategori')}}">
              <i class="material-icons">all_inbox</i>
              <p>Kategori</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='pegawai'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('pegawai')}}">
              <i class="material-icons">work</i>
              <p>Pegawai</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='pojok'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('pojok')}}">
              <i class="material-icons">desktop_windows</i>
              <p>Pojok IT</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='user'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('user')}}">
              <i class="material-icons">perm_identity</i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='saran'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('saran')}}">
              <i class="material-icons">chat</i>
              <p>Saran & Kritik</p>
            </a>
          </li>          
        </ul>
      </div>