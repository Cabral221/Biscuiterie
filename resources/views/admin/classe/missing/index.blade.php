@extends('layouts.app', ['titlePage' => $classe->libele . ' | Gestion d\'absence'])

@section('plugin-css')
    <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        {{ $classe->libele }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.classes.show', $classe) }}"><i class="fa fa-dashboard"></i> {{ $classe->libele }}</a></li>
        <li class="active">{{ $classe->libele }}</li>
    </ol>
</section>

<section class="content">

    <!-- Default box -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Liste des feuilles d'absences</h3>
            
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered table-striped" id="missing-recent">
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>nombre d'Absent</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($missings as $missing)
                    <tr>
                        <td><a href="#">{{ $missing->created_at }}</a></td>
                        <td><span class="title p-2 bg-primary">{{ $missing->missingCount }}</span></td>
                        <td><a href="#" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
@endsection

@section('plugin-js')
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endsection
    
@section('js')
<script defer>
    $(document).ready(function () {
        $('#missing-recent').DataTable({
            responsive: true,
            ordering: false,
        });
    });
</script>
@endsection
