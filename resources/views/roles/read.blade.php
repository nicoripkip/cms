@extends('layouts.master')
@section('title', 'Rechten - Read')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Gebruikers
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.role.index') }}">Rechten</a></li>
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
            <h3 class="box-title">Rechten</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.role.create') }}">Nieuw</a>
        </div>
        
        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titel</th>
                    <th>Omschrijving</th>
                    <th>Gemaakt op</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->title }}</td>
                        <td>{{ $role->description }}</td>
                        <td>{{ $role->created_at }}</td>
                        <td><a class="btn btn-warning" href="{{ route('admin.role.update', $role->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.role.delete', $role->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <form id="delete-form" method="post" action="{{ route('admin.role.delete', [$role->id]) }}" style="display:none;">
      @csrf
    </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

  function sure() {
    return confirm("Weet je het zeker dat je de rechten wilt verwijderen!");
  }

  $(function () {
        $('#myexample').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

@endsection