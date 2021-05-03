@extends('layouts.app', ['titlePage' => 'Historique'])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        Consulter l'historique
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Historique</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header">
            formulaire de selection de l'année scolaire
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form action="#" method="POST" id="form_range_history">
                <div class="form-group">
                    <label for="range" class="mr-4"><h4>Selection l'année scolaire</h4></label>
                    <select name="year" required>
                        @foreach ($years as $k => $year)
                            <option value="{{ $k }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div id="histories_content"></div>
        </div>
        <!-- /.box-body -->
    </div>
</section>
@endsection

@section('plugin-js')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}" defer></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}" defer></script>
@endsection

@section('js')
<script defer>
    $(function () {
        $('#example1').DataTable({
            pageLength: 50
        })
    })
</script>
@endsection