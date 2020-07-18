<header class="main-header">

  <!-- Logo -->
  <a href="admin" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">@if(isset($algemeen['cms_naam'])) {{ $algemeen['cms_naam'] }} @else CMS @endif</span>
  </a>

  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" style="background-color: #ECF0F5">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        
        <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span id="badge-meldingen" class="badge btn-warning navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span id="length-meldingen" class="dropdown-item dropdown-header pull-center">0 Meldingen</span>
          @foreach($messages as $message)
            <div class="dropdown-divider"></div>
            <div class="dropdown-item melding-item">
              <i class="{{ $message->image }}"></i> {{ $message->name }}
              <span class="float-right text-muted text-sm">{{ $message->message }}</span>
              <button class="btn btn-melding pull-right" style="background-color: transparent;" onclick="removeMessage(this);return false"><i class="fas fa-times"></i></button>
              <input type="hidden" name="id" value="{{ $message->id }}" />
              <input type="hidden" name="date" value="{{ $message->date }}" />
              <input type="hidden" name="time" value="{{ $message->time }}" />
              <input type="hidden" name="image" value="{{ $message->image }}" />
              <input type="hidden" name="message" value="{{ $message->message }}" />
              <input type="hidden" name="name" value="{{ $message->name }}" />
            </div>
          @endforeach
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer pull-center">Alle meldingen bekijken</a>
        </div>
      </li>

        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset(Auth::user()->image) }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{ Auth::user()->name }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset(Auth::user()->image) }}" class="img-circle" alt="User Image">

              <p style="color: black;">
              {{ Auth::user()->name }}
                <small>Lid sinds {{ Auth::user()->created_at }}</small>
              </p>
            </li>

            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profiel</a>
              </div>
              <div class="pull-right">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                                      class="btn btn-default btn-flat">uitloggen</a>
                
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>

  </nav>
</header>

<script>
  let notifications = document.getElementById('length-meldingen');
  let badge = document.getElementById('badge-meldingen');

  notifications.innerText = `${notifications.parentElement.querySelectorAll('.melding-item').length} Meldingen`;

  if (badge.parentElement.nextElementSibling.querySelectorAll('.melding-item').length == 0) {
    badge.style.display = 'none';
  }

  badge.innerText = badge.parentElement.nextElementSibling.querySelectorAll('.melding-item').length;

  function removeMessage(e) {
    let card = e.parentElement;
    let dat = card;
    card.parentElement.removeChild(card);

    notifications.innerText = `${notifications.parentElement.querySelectorAll('.melding-item').length} Meldingen`;
    if (badge.parentElement.nextElementSibling.querySelectorAll('.melding-item').length == 0) {
      badge.style.display = 'none';
    }
    badge.innerText = badge.parentElement.nextElementSibling.querySelectorAll('.melding-item').length;

    let data = {
      'id': dat.children[3].value,
      'name': dat.children[8].value,
      'message': dat.children[7].value,
      'image': dat.children[6].value,
      'read': 1,
      'date': dat.children[4].value,
      'time': dat.children[5].value,
      '_token': '{{ csrf_token() }}',
    }

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      'type': 'POST',
      'url': 'http://127.0.0.1:8000/ajax/post/updateMessage',
      'dataType': 'json',
      'data': data,
      success: function(response) {

      },
      error: function(xhr, ajaxOptions, webRequest) {
        alert(xhr.status);
        alert(xhr.responseText);
        alert(thrownError);
      }
    });
  }
</script>