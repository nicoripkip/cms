@extends('layouts.master')
@section('title', 'Module | read')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Modules
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.module.index') }}">Modules</a></li>
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
            <h3 class="box-title">Modules</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.module.create') }}">Nieuw</a>
        </div>

        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Icoon</th>
                    <th>Slug</th>
                    <th>Gecreeërd op</th>
                    <th>Builder</th>
                    <th>Updaten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($modules as $module)
                    <tr class="table_row">
                        <td>{{ $module->id }}</td>
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->icon }}</td>
                        <td>{{ $module->slug }}</td>
                        <td>{{ $module->created_at }}
                        <td><a class="btn btn-info" href="{{ route('admin.module.builder', $module->id) }}"><i class="fas fa-cog"></i></a></td>
                        <td><a class="btn btn-warning" href="{{ route('admin.module.update', $module->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.module.delete', $module->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <form id="delete-form" method="post" action="{{ route('admin.module.delete', [$module->id ?? '']) }}" style="display:none;">
        @csrf
      </form>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script>
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



function sure() {
  return confirm("Weet je het zeker dat je de module wilt verwijderen!");
}
</script>

@endsection