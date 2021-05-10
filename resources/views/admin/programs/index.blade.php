@extends('layouts.app', ['titlePage' => 'Programme d\'étude'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des programmes d'étude
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Programme</li>
    </ol>
</section>

<section class="content">
    <div class="box box-primary">
        <div class="box-header text-center">
            <h3 class="box-title">Création de programme</h3>
        </div>
        <div class="box-body">
           <div class="d-flex justify-content-center">
                <form action="{{ route('admin.programs.store') }}" method="POST" class="text-center">
                    @csrf
                    <div class="form-group @error('libele') has-error @enderror">
                        <label>Nomn du programme</label>
                        <input type="text" name="libele" class="form-control">
                        @error('libele')
                            <span class="help-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
           </div>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="row">
        @foreach ($programs as $program)
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Programme : <span class="text-primary">{{ $program->libele }}</span></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="niveau_card p-3 mb-3 border shadow border-blue">
                        <h4>Niveaux</h4>
                        @foreach ($program->niveaux as $niveau)
                            <span class="badge badge-primary">{{ $niveau->libele }}</span>
                        @endforeach
                        <button class="badge badge-success float-right niveau_toggle_form"><i class="fa fa-plus"></i></button>
                        <div class="mt-2 d-none form_add_niveau">
                            <form action="#" method="post" class="form" style="width: 100%">
                                @csrf
                                @method('POST')
                                <input type="text" name="niveau_id" class="d-none" value="{{ $program->id }}" disabled>
                                <div class="form-group">
                                    <label for="libele_niveau_{{$program->id}}">Ajouter un niveau</label>
                                    <input type="text" class="form-control" id="libele_niveau_{{$program->id}}" placeholder="Libellé du niveau">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h4>Domaines</h4>
                        @foreach ($program->domains as $domain)
                        <ul>
                            <li>
                                <span class="">{{ $domain->libele }}</span>
                                @if (count($domain->sub_domains) > 0)
                                    <ul>
                                        @foreach ($domain->sub_domains as $subdomain)
                                            <li><span class="">{{ $subdomain->libele }}</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        </ul>
                        @endforeach
                    </div>
                    {{-- <a href="{{ route('admin.programs.show', $program->id) }}" class="btn btn-block btn-primary btn-sm">+ Détails</a> --}}
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        @endforeach
    </div>
    

</section>
@endsection
