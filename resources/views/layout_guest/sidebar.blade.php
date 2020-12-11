<div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php if($state=='pojok'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('pojok-it')}}">
              <i class="material-icons">desktop_windows</i>
              <p>Pojok IT</p>
            </a>
          </li>
          <li class="nav-item <?php if($state=='saran'){echo 'active';} ?>">
            <a class="nav-link" href="{{url('input-saran')}}">
              <i class="material-icons">chat</i>
              <p>Saran & Kritik</p>
            </a>
          </li>          
        </ul>
      </div>