@extends('layouts.app', ['titlePage' => 'Gestion des utilisateurs'])

@section('content')
<section class="content-header">
    <h1>
        Gestion du personnel
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Personnel</li>
    </ol>
</section>
@endsection