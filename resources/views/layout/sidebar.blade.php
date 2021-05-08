<div class="sidebar-wrapper">
  <ul class="nav">
    @hasrole('admin')
    <li class="nav-item <?php if($state=='dashboard'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('dashboard')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    @endhasrole
    @hasrole('dispatcher_unit')
    <li class="nav-item <?php if($state=='dashboard-unit'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('dashboard-unit')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='statistic'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('statistic')}}">
        <i class="fa fa-pie-chart" aria-hidden="true"></i>
        <p>Statistic</p>
      </a>
    </li>
    @endhasrole
    @hasrole('dispatcher_unit')
    <li class="nav-item <?php if($state=='statistic-unit'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('statistic-unit')}}">
        <i class="fa fa-pie-chart" aria-hidden="true"></i>
        <p>Statistic</p>
      </a>
    </li>
    @endhasrole
    <!-- @hasrole('admin')
    <li class="nav-item <?php if($state=='analytics'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('analytics')}}">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        <p>Analytics All</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin|dispatcher_unit')
    <li class="nav-item <?php if($state=='analytics-unit'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('analytics-unit')}}">
        <i class="fa fa-bar-chart" aria-hidden="true"></i>
        <p>Analytics</p>
      </a>
    </li>
    @endhasrole -->
    @hasrole('admin')
    <li class="nav-item <?php if($state=='tiket'){echo 'active';} ?>">
      <a class="<?php if($state=='tiket'){echo 'nav-link';}else{echo 'dropdown-btn';} ?>">
        <i class="material-icons">post_add</i>
          <p>Tiket</p>
      </a>        
      <ul class="<?php if($state=='tiket'){echo 'nav';}else{echo 'dropdown-container';} ?>" >
        <a class="nav-link" href="{{url('tiket')}}"><span class="material-icons">narrow_right</span> All</a>
        <a class="nav-link" href="{{url('tiket-open')}}"><span class="material-icons">narrow_right</span> Open</a>
        <!-- <a class="nav-link" href="{{url('tiket-createitsm')}}"><span class="material-icons">narrow_right</span> Create ITSM</a> -->
        <a class="nav-link" href="{{url('tiket-assigned')}}"><span class="material-icons">narrow_right</span> Assigned</a>
        <a class="nav-link" href="{{url('tiket-resolved')}}"><span class="material-icons">narrow_right</span> Resolved</a>
      </ul>
    </li>
    @endhasrole
    @hasrole('dispatcher_unit')
    <li class="nav-item <?php if($state=='tiket-unit'){echo 'active';} ?>">
      <a class="<?php if($state=='tiket-unit'){echo 'nav-link';}else{echo 'dropdown-btn';} ?>">
        <i class="material-icons">post_add</i>
          <p>Tiket</p>
      </a>        
      <ul class="<?php if($state=='tiket-unit'){echo 'nav';}else{echo 'dropdown-container';} ?>" >
        <a class="nav-link" href="{{url('tiket-unit')}}"><span class="material-icons">narrow_right</span> All</a>
        <a class="nav-link" href="{{url('tiket-open-unit')}}"><span class="material-icons">narrow_right</span> Open</a>
        <!-- <a class="nav-link" href="{{url('tiket-createitsm-unit')}}"><span class="material-icons">narrow_right</span> Create ITSM</a> -->
        <a class="nav-link" href="{{url('tiket-assigned-unit')}}"><span class="material-icons">narrow_right</span> Assigned</a>
        <a class="nav-link" href="{{url('tiket-resolved-unit')}}"><span class="material-icons">narrow_right</span> Resolved</a>
      </ul>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='report'){echo 'active';} ?>">
      <a class="<?php if($state=='report'){echo 'nav-link';}else{echo 'dropdown-btn';} ?>">
        <i class="material-icons">list</i>
          <p>Report All</p>
      </a>        
      <ul class="<?php if($state=='report'){echo 'nav';}else{echo 'dropdown-container';} ?>" >
        <a class="nav-link" href="{{url('report-harian')}}"><span class="material-icons">narrow_right</span> Harian</a>
        <a class="nav-link" href="{{url('report-bulanan')}}"><span class="material-icons">narrow_right</span> Bulanan</a>
        <a class="nav-link" href="{{url('report-kategori')}}"><span class="material-icons">narrow_right</span> Kategori</a>
        <a class="nav-link" href="{{url('report-itsupport')}}"><span class="material-icons">narrow_right</span> IT Support</a>
        <a class="nav-link" href="{{url('report-pegawai')}}"><span class="material-icons">narrow_right</span> Pegawai</a>
      </ul>
    </li>
    @endhasrole
    @hasrole('dispatcher_unit')
    <li class="nav-item <?php if($state=='report-unit'){echo 'active';} ?>">
      <a class="<?php if($state=='report-unit'){echo 'nav-link';}else{echo 'dropdown-btn';} ?>">
        <i class="material-icons">list</i>
          <p>Report</p>
      </a>        
      <ul class="<?php if($state=='report-unit'){echo 'nav';}else{echo 'dropdown-container';} ?>" >
        <a class="nav-link" href="{{url('report-harian-unit')}}"><span class="material-icons">narrow_right</span> Harian</a>
        <a class="nav-link" href="{{url('report-bulanan-unit')}}"><span class="material-icons">narrow_right</span> Bulanan</a>
        <a class="nav-link" href="{{url('report-kategori-unit')}}"><span class="material-icons">narrow_right</span> Kategori</a>
        <a class="nav-link" href="{{url('report-itsupport-unit')}}"><span class="material-icons">narrow_right</span> IT Support</a>
        <a class="nav-link" href="{{url('report-pegawai-unit')}}"><span class="material-icons">narrow_right</span> Pegawai</a>
      </ul>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='kategori'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('kategori')}}">
        <i class="material-icons">all_inbox</i>
        <p>Kategori</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='pegawai'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('pegawai')}}">
        <i class="material-icons">work</i>
        <p>Pegawai</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='pojok'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('pojok')}}">
        <i class="material-icons">desktop_windows</i>
        <p>Pojok IT</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin')
    <li class="nav-item <?php if($state=='user'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('user')}}">
        <i class="material-icons">perm_identity</i>
        <p>User</p>
      </a>
    </li>
    @endhasrole
    @hasrole('admin|dispatcher_unit')
    <li class="nav-item <?php if($state=='saran'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('saran')}}">
        <i class="material-icons">chat</i>
        <p>Saran & Kritik</p>
      </a>
    </li>
    @endhasrole
    <!-- @hasrole('admin|dispatcher_unit')
    <li class="nav-item <?php if($state=='cuti'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('cuti')}}">
        <i class="material-icons">person_off</i>
        <p>Cuti</p>
      </a>
    </li>
    @endhasrole -->
    <!-- @hasrole('admin')
    <li class="nav-item <?php if($state=='mapping'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('mapping')}}">
        <i class="material-icons">perm_identity</i>
        <p>Mapping</p>
      </a>
    </li> -->
    <li class="nav-item <?php if($state=='sponsor'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('sponsor')}}">
        <i class="material-icons">contactless</i>
        <p>Awareness</p>
      </a>
    </li>
    @endhasrole
    <!-- <li class="nav-item <?php if($state=='chatkategori'){echo 'active';} ?>">
      <a class="nav-link" href="{{url('chatkategori')}}">
        <i class="material-icons">inbox</i>
        <p>Chat Kategori</p>
      </a>
    </li> -->          
  </ul>
</div>
