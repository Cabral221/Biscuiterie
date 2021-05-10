@extends('layouts.app', ['titlePage' => 'Historique'])

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
