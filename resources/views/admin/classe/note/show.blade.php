@extends('layouts.app', ['titlePage' => $student->classe->libele . ' | Gestion des notes'])

@section('plugin-css')
<link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('content')
<section class="content-header">
    <h1>
        {{ $student->classe->libele }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.classes.show', $student->classe) }}"><i class="fa fa-dashboard"></i> {{ $student->classe->libele }}</a></li>
        <li><a href="{{ route('admin.classes.notes.index', [$student->classe]) }}"><i class="fa fa-dashboard"></i> Notes</a></li>
        <li class="active">{{ $student->first_name }} {{ $student->last_name }}</li>
    </ol>
</section>

<section class="content">

     <!-- Default box -->
     <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Fiche de notes</h3>
            
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
            <table id="note-table" class="table table-bordered" data-page-length='100'>
                <thead>
                    {{-- <th colspan="2">Domaines</th> --}}
                    <th>Activités</th>
                    <th class="text-center">1ére <br> Composition</th>
                    <th class="text-center">2ème <br> Composition</th>
                    <th class="text-center">3ème <br> Composition</th>
                    <th>Récaputulations</th>
                </thead>
                <tbody>
                    @foreach ($notes as $note)
                        <tr>
                            {{-- @if (is_array($note->domainExact))
                                <td>true</td>
                                <td>true</td>
                            @else
                                @if ($note->domainExact != null)
                                    <td colspan="2" rowspan="{{ $note->rowspanCount }}">
                                        {{ $note->domainExact }}
                                    </td>
                                @endif
                            @endif --}}
                            <td>{{ $note->activity->libele }}</td>
                            <td class="text-bold text-center">
                                {{ $note->note1 }} / {{ $note->activity->dividente }}
                            </td>
                            <td class="text-bold text-center">
                                {{ $note->note2 }} / {{ $note->activity->dividente }}
                            </td>
                            <td class="text-bold text-center">
                                {{ $note->note3 }} / {{ $note->activity->dividente }}
                            </td>
                            <td>...</td>
                        </tr>
                    @endforeach
                    <tr class="h4 text-bold">
                        <td class="text-center" colspan="1">TOTAL GENERAL</td>
                        @foreach ($student->totalGen() as $tot)
                            <td class="text-center">{{ $tot }} / {{ $student->totSommeDividente() }}</td>
                        @endforeach
                        <td>Recapitulation</td>
                    </tr>
                    <tr class="h4 text-bold">
                        <td class="text-center" colspan="1">MOYENNE</td>
                        @foreach ($student->moy() as $moy)
                            <td class="text-center">{{ $moy }} / {{ $student::DIVIDEUR }}</td>
                        @endforeach
                        <td>Recapitulation</td>
                    </tr>
                    <tr class="h4 text-bold">
                        <td class="text-center" colspan="1">RANG</td>
                        
                        <td class="text-center">{{ $student->rang(1) }}</td>
                        <td class="text-center">{{ $student->rang(2) }}</td>
                        <td class="text-center">{{ $student->rang(3) }}</td>
                        
                        <td>...</td>
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
<script defer>
    $(document).ready(function () {
        $('#note-table').DataTable({
            responsive: true,
            ordering: false,
        });
    });
</script>
@endsection
