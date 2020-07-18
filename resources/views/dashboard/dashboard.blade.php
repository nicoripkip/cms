@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
  @parent
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>Home</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection