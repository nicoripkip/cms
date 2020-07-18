@extends('layouts.master')
@section('title', 'Rechten - Create')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Rechten
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.role.index') }}">Rechten</a></li>
      <li><a href="{{ route('admin.role.create') }}">Rechten aanmaken</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <div class="box box-primary" style="border-top-color: #1AA650;">
        <div class="box-header with-border">
            <h3 class="box-title">Rechten aanmaken</h3>
        </div>

        <form action="{{ route('admin.role.store') }}" method="POST">
            <div class="form-group">
                <label class="form-text">Selecteer de Rechten per pagina</label>
            </div>
            <!-- Gebruikers rol -->
            <div class="form-group">
                <label class="form-text">Rol naam: *</label>
                <input type="text" name="title" class="form-control" placeholder="Rol naam.." required />
            </div> 
            @foreach ($permissions as $permission)
                <div class="form-control">
                    <label class="form-text">{{ $permission->name }}</label>
                    <input type="hidden" name="role[{{ $permission->name }}]" value=0 />
                    <input type="checkbox" name="role[{{ $permission->name }}]" class="pull-right" value=1 />
                </div>
            @endforeach
            <!-- Opslaan knop -->
            <div class="form-group">
                @csrf
                <input type="submit" name="submit" class="btn btn-success" value="Rechten opslaan" />
            </div>
        </form>
        
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection