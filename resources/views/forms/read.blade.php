@extends('layouts.master')
@section('title', 'Formulieren | read')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Formulieren
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.index') }}">Formulieren</a></li>
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
            <h3 class="box-title">Formulieren</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.forms.create') }}">Nieuw</a>
        </div>

        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Icoon</th>
                    <th>Value</th>
                    <th>Downloaden</th>
                    <th>Builder</th>
                    <th>Updaten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($forms as $form)
                    <tr class="table_row">
                        <td>{{ $form->id }}</td>
                        <td>{{ $form->name }}</td>
                        <td>{{ $form->description }}</td>
                        <td>{{ $form->icon }}</td>
                        <td>{{ $form->value }}</td>
                        <td><a class="btn btn-info" href="{{ route('admin.forms.export', $form->id) }}"><i class="fas fa-download"></i></a></tc>
                        <td><a class="btn btn-info" href="{{ route('admin.forms.builder', $form->id) }}"><i class="fas fa-cog"></i></a></td>
                        <td><a class="btn btn-warning" href="{{ route('admin.forms.update', $form->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.forms.delete', $form->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>

    <form id="delete-form" method="post" action="{{ route('admin.forms.delete', [$form->id ?? '']) }}" style="display:none;">
        @csrf
      </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>
    function sure() {
      return confirm("Weet je het zeker dat je de Formulieren wilt verwijderen!");
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