@extends('layouts.master')
@section('title', 'ModuleItem | read')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
        {{ $modules->name }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li><a href="{{ route('admin.moduleitem.index', [$modules->slug]) }}">{{ $modules->name }}</a></li>
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
            <h3 class="box-title">Read</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.moduleitem.create', [$modules->slug]) }}">Nieuw</a>
        </div>

        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($table_items as $item) 
                        <th>{{ $item->Attributes->name }}</th>
                    @endforeach
                    <th>Updaten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($moduleitem as $value)
                    <tr class="table_row">
                        <td>{{ $value->id }}</td>
                        @foreach($table_items as $item)
                            <td>{{ $value->{$item->Attributes->name} ?? ' ' }}</td>
                        @endforeach
                        <td><a class="btn btn-warning" href="{{ route('admin.moduleitem.update', [$modules->slug, $value->id]) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.moduleitem.delete', [$modules->slug, $value->id]) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>

    <form id="delete-form" method="post" action="{{ route('admin.moduleitem.delete', [$modules->slug, $value->id ?? '']) }}" style="display:none;">
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
  return confirm("Weet je het zeker dat je de module item wilt verwijderen!");
}
</script>

@endsection