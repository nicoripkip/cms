@extends('layouts.master')
@section('title', 'Gebruikers - Read')
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
      <li><a href="{{ route('admin.user.index') }}">Gebruikers</a></li>
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
            <h3 class="box-title">Gebruikers</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.user.create') }}">Nieuw</a>
        </div>
        
        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Gebruikersnaam</th>
                    <th>Email adres</th>
                    <th>Afbeelding</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->image }}</td>
                        <td><a class="btn btn-warning" href="{{ route('admin.user.update', $user->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.user.delete', $user->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <form id="delete-form" method="post" action="{{ route('admin.user.delete', [$user->id ?? '']) }}" style="display:none;">
      @csrf
    </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>

  function sure() {
    return confirm("Weet je het zeker dat je de gebruiker wilt verwijderen!");
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