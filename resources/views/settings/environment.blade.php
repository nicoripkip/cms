@extends('layouts.master')
@section('title', 'Settings - Environment')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Environment
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
          <!-- Main content -->
  <section class="content">
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">Instellingen</h3>
        </div>
        
        <form action="{{ route('admin.setting.put', ['environment']) }}" method="POST">
          <!-- Alle File data -->
          @foreach ($env_settings as $key => $env)
            <div class="form-group">
                <label class="form-text">{{ Str::before($env, '=') }}</label>
                <input type="text" name="settings[{{ Str::before($env, '=') }}]" value="{{ Str::after($env, '=') }}" class="form-control" />
            </div>            
          @endforeach
          <!-- submit button -->
          <div class="form-group">
            @csrf
            <input type="submit" name=submit" class="btn btn-custom btn-success" value="Instellingen opslaan" />
          </div>
        </form>
        
    </div>

  </section>
  <!-- /.content -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
  function warning() {
    let x = confirm("Deze pagina is alleen voor ervaren gebruikers\nWilt u toch doorgaan");

    if (x == false) {
      return location.href = "/admin/setting/algemeen";
    }
  }

  window.onload = warning();
</script>

@endsection