@extends('layouts.master')
@section('title', 'Mail | read')
{{-- @include('partials.meta'); --}}
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Mails
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Dashboard</a></li>
      <li><a href="{{ route('admin.mails.index') }}">Mails</a></li>
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
            <h3 class="box-title">Mails</h3>
            <a class="btn btn-success pull-right" href="{{ route('admin.mails.create') }}">Nieuw</a>
        </div>

        <table id="myexample" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Gecreeërd op</th>
                    <th>Data</th>
                    <th>Updaten</th>
                    <th>Verwijderen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mails as $mail)
                    <tr class="table_row">
                        <td>{{ $mail->id }}</td>
                        <td>{{ $mail->name }}</td>
                        <td>{{ $mail->description }}</td>
                        <td>{{ $mail->created_at }}
                        <td><a class="btn btn-info" href="{{ route('admin.mails.builder', $mail->id) }}"><i class="fas fa-cog"></i></a></td>
                        <td><a class="btn btn-warning" href="{{ route('admin.mails.update', $mail->id) }}"><i class="fas fa-pencil-alt"></i></a></td>
                        <td><a class="btn btn-danger" href="{{ route('admin.mails.delete', $mail->id) }}"
                          onclick="event.preventDefault();sure();document.getElementById('delete-form').submit();">
                          <i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <form id="delete-form" method="post" action="{{ route('admin.mails.delete', [$mail->id ?? '']) }}" style="display:none;">
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
  return confirm("Weet je het zeker dat je de mail wilt verwijderen!");
}
</script>

@endsection