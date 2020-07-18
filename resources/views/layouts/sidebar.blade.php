<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar" style="background-color: #000; color: #fff; opacity: 0.9;">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel" style="height: 80px;">
      <div class="pull-left image">
        <img src="{{ asset(Auth::user()->image) }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree" style="color: #fff; font-size: 18px;">
      <li class="header">Navigatie</li>
        <!-- Menu item Dashboard -->
        <li>
          <a href="{{ route('admin.index') }}" class="menu-hover" style="color: #fff">
            <i class="fas fa-tachometer-alt menu-icon"></i> <span>Dashboard</span>
          </a>
        </li>
        <!-- Menu item Slides -->
        <li>
          <a href="{{ route('admin.menu.index') }}" class="menu-hover" style="color: #fff">
            <i class="fas fa-ellipsis-v menu-icon"></i> <span>Menu</span>
          </a>
        </li>
        <!-- Menu item Pagina -->
        <li>
          <a href="{{ route('admin.page.index') }}" class="menu-hover" style="color: #fff">
            <i class="far fa-file menu-icon"></i> <span>Pagina</span>
          </a>
        </li>
        <!-- Menu item Thema -->
        <li>
          <a href="{{ route('admin.theme.index') }}" class="menu-hover" style="color: #fff">
            <i class="far fa-image menu-icon"></i> <span>Thema's</span>
          </a>
        </li>
        <!-- Menu item Modules -->
        <li>
          <a href="{{ route('admin.module.index') }}" class="menu-hover" style="color: #fff">
            <i class="fa fa-th menu-icon"></i> <span>Module</span>
          </a>
        </li>
        <!-- Menu item Module items -->
        @foreach ($modules as $item)
          <li>
            <a href="{{ route('admin.moduleitem.index', [$item->slug]) }}" class="menu-hover" style="color: #fff">
              {{ trim(print($item->icon), 1) }} <span>{{ $item->name }}</span>
            </a>
          </li>
        @endforeach
        <!-- Menu item Preferals -->
        <li>
          <a class="drop-btn" href="#" class="menu-hover" style="color: #fff"><i class="fas fa-mouse menu-icon"></i>Peripherals</a>
          <div id="myDropdown" class="dropdown-content" style="display: none">
            <ul class="sidebar-menu">
              <!-- Menu item Attributes -->
              <li>
                <a href="{{ route('admin.attribute.index') }}" class="menu-hover" style="color: #fff">
                  <i class="fa fa-th menu-icon"></i> <span>Attribute</span>
                </a>
              </li>
              <!-- Menu item Templates -->
              <li>
                <a href="{{ route('admin.template.index') }}" class="menu-hover" style="color: #fff">
                  <i class="far fa-file-alt menu-icon"></i> <span>Templates</span>
                </a>
              </li>
               <!-- Menu item Formulieren -->
               <li>
                <a href="{{ route('admin.forms.index') }}" class="menu-hover" style="color: #fff">
                  <i class="fab fa-wpforms"></i> <span>Formulieren</span>
                </a>
              </li>
              <!-- Menu item Mails -->
              <li>
                <a href="{{ route('admin.mails.index') }}" class="menu-hover" style="color: #fff">
                  <i class="far fa-envelope"></i> <span>Mail</span>
                </a>
              </li>
            </ul>
          </div>  
          
        </li>
        <!-- Menu item Gebruikers -->
        <li>
          <a class="drop-btn" href="#" class="menu-hover" style="color: #fff"><i class="far fa-user menu-icon"></i>Gebruikers</a>
          <div id="myDropdown" class="dropdown-content" style="display: none">
            <ul class="sidebar-menu">
              <li>
                <a href="{{ route('admin.user.index') }}" class="menu-hover" style="color: #fff">
                  <i class="far fa-user menu-icon"></i> <span>Gebruikers</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.role.index') }}" class="menu-hover" style="color: #fff">
                  <i class="fas fa-cogs menu-icon"></i> <span>Rechten</span>
                </a>
              </li>
            </ul>
          </div>  
          
        </li>
        <!-- Menu item Instellingen -->
        <li>
          <a href="#" class="drop-btn" class="menu-hover" style="color: #fff">
            <i class="fas fa-cogs menu-icon"></i> <span>Instellingen</span>
          </a>
          <div id="myDropdown" class="dropdown-content" style="display: none">
            <ul class="sidebar-menu">
              <li>
                <a href="{{ route('admin.setting.index', ['algemeen']) }}" class="menu-hover" style="color: #fff">
                  <i class="fa fa-th menu-icon"></i> <span>Algemeen</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.setting.index', ['socialmedia']) }}" class="menu-hover" style="color: #fff">
                  <i class="fa fa-th menu-icon"></i> <span>Social Media</span>
                </a>
              </li>
              <li>
                <a href="{{ route('admin.setting.index', ['environment']) }}" class="menu-hover" style="color: #fff">
                  <i class="fa fa-th menu-icon"></i> <span>Environment</span>
                </a>
              </li>
            </ul>
        </div> 
        </li>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<script>
  $('.drop-btn').click(function() {
    if($(this).next().is(':visible')) {
      $(this).next().hide();
      $(this).prepend('<i class=""fas fa-caret-down></i>');
    } else if (!$(this).next().is(':visible')) {
      $(this).next().show();
    }
  });

  window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>