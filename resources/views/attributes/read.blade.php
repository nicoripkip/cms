@extends('layouts.master')
@section('title', 'Attributes | read')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Attributes
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.attribute.index') }}">Attributen</a></li>
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
            <h3 class="box-title">Attributes</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.attribute.create') }}">Nieuw</a>
        </div>

        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Groep</th>
                    <th>Type</th>
                    <th>Bewerken</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attributes as $attribute)
                    <tr class="table_row">
                        <td>{{ $attribute->id }}</td>
                        <td>{{ $attribute->name }}</td>
                        <td>{{ $attribute->group }}</td>
                        <td>{{ $attribute->type }}</td>
                        <td><a class="btn btn-warning" href="{{ route('admin.attribute.update', [$attribute->id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.attribute.delete', [$attribute->id]) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <form id="delete-form" method="post" action="{{ route('admin.attribute.delete', [$attribute->id ?? '']) }}" style="display:none;">
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
      return confirm("Weet je het zeker dat je de Attribute wilt verwijderen!");
    }
  </script>

@endsection