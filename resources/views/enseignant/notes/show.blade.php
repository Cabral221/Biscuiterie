
@extends('layouts.app', ['titlePage' => 'Fiche de notes - '. $student->fullName])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        {{ $student->fullName }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('master.index') }}"><i class="fa fa-dashboard"></i> Tableu de bord</a></li>
        <li><a href="{{ route('master.notes.index') }}"><i class="fa fa-dashboard"></i> Notes</a></li>
        <li class="active"><i class="fa fa-dashboard"></i> {{ $student->fullName }}</li>
    </ol>
</section>

<section class="content">

     <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Fiche de notes : <span class="text-primary">{{ $student->fullName }}</span></h3>
            
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
            <p>Hello world !</p>
            <table class="table table-bordered">
                <thead>
                    <th colspan="2">Domaines</th>
                    <th>Activités</th>
                    <th class="text-center">1ére <br> Composition</th>
                    <th class="text-center">2ème <br> Composition</th>
                    <th class="text-center">3ème <br> Composition</th>
                    <th>Récaputulations</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
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
<script>
    $(function () {
        $('#example1').DataTable({
            "paginate": false,
        })
    })
</script>
@endsection
