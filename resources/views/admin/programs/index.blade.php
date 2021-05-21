@extends('layouts.app', ['titlePage' => 'Programme d\'étude'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des programmes d'études
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
                        <label>Nom du programme</label>
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
                            <form action="{{ route('admin.programs.niveaux.store') }}" method="post" class="form form_niveaux" style="width: 100%">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="program_id" value="{{ $program->id }}" required>
                                <div class="form-group">
                                    <label for="niveau_libele_{{$program->id}}">Ajouter un niveau</label>
                                    <input type="text" class="form-control" name="libele" id="niveau_libele_{{$program->id}}" placeholder="Libellé du niveau" required autofocus>
                                </div>
                                <div class="position-relative text-center niveau_info"></div>
                            </form>
                        </div>
                    </div>
                    <div class="classe_card p-3 mb-3 border border-blue shadow">
                        <h4>Classes</h4>
                        @foreach ($program->niveaux as $niveau)
                            @foreach ($niveau->classes as $classe)
                                <span class="badge badge-primary">{{ $classe->libele }}</span>
                            @endforeach
                        @endforeach
                        <button class="badge badge-success float-right classe_toggle_form"><i class="fa fa-plus"></i></button>
                        <div class="mt-2 d-none form_add_classe">
                            <form action="{{ route('admin.programs.classes.store') }}" method="post" class="form form_classe" style="width: 100%">
                                @csrf
                                @method('POST')
                                <input type="hidden" name="program_id" value="{{$program->id}}">

                                <div class="form-group">
                                    <label for="classe_niveau_id_{{$program->id}}">Lier au niveau d'etude</label>
                                    <select name="niveau_id" id="classe_niveau_id_{{$program->id}}" class="form-control" required>
                                        <option value="">Selectionnez un niveau</option>
                                        @foreach ($program->niveaux as $n)
                                            <option value="{{ $n->id }}">{{ $n->libele }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="classe_user_id_{{$program->id}}">Affecter un(e) Enseigant(e)</label>
                                    <select name="user_id" class="form-control" id="classe_user_id_{{$program->id}}" required>
                                        <option value="">Selectionnez un(e) enseignant(e)</option>
                                        @foreach ($freeMaster as $enseignant)
                                            <option value="{{ $enseignant->id }}">{{ $enseignant->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="classe_libele_{{$program->id}}">Libellé de la classe</label>
                                    <input type="text" class="form-control" name="libele" id="classe_libele_{{$program->id}}" placeholder="Libellé du niveau" required autofocus>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-xs btn-success">Créer la classe</button>
                                </div>
                                <div class="position-relative text-center classe_info"></div>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h4>Domaines</h4>
                        @foreach ($program->domains as $domain)
                        <ul>
                            <li>
                                <span>{{ $domain->libele }}</span>
                                @if (count($domain->sub_domains) > 0)
                                    <ul>
                                        @foreach ($domain->sub_domains as $subdomain)
                                            <li><span>{{ $subdomain->libele }}</span></li>
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
