@extends('layouts.app', ['titlePage' => 'Historique'])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Consulter l'historique des enseigants
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Historique</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div id="histories_content"></div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection

@section('plugin-js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection

@section('js')
<script>
    $(function () {
        $('#example1').DataTable({
            pageLength: 50,
            // responsive: true,
            scrollResize: true,
            scrollX: 100,
            scrollCollapse: true,
        })
    })
</script>
@endsection
