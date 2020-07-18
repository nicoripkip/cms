@extends('layouts.master')
@section('title', 'Pages | read')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Pages
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
      <li><a href="{{ route('admin.page.index') }}"></i>Pagina's</a></li>
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
            <h3 class="box-title">Pages</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.page.create') }}">Nieuw</a>
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
                @foreach ($pages as $page)
                    <tr class="table_row">
                        <td>{{ $page->id }}</td>
                        <td>{{ $page->name }}</td>
                        <td>{{ $page->icon }}</td>
                        <td>{{ $page->view }}</td>
                        <td>{{ $page->created_at }}
                        <td><a class="btn btn-info" href="{{ route('admin.page.builder', $page->id) }}"><i class="fas fa-cog"></i></a></td>
                        <td><a class="btn btn-warning" href="{{ route('admin.page.update', $page->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.page.delete', $page->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <form id="delete-form" method="post" action="{{ route('admin.page.delete', [$page->id ?? '']) }}" style="display:none;">
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
  return confirm("Weet je het zeker dat je de gebruiker wilt verwijderen!");
}
</script>

@endsection