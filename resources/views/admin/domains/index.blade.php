@extends('layouts.app', ['titlePage' => 'Domaine d\'étude'])

@section('content')
<section class="content-header">
    <h1>
        Gestion des Domaines
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li class="active">Domaines</li>
    </ol>
</section>

<section class="content">
    
    <div class="row">
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Création d'un domaine</h3>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.domains.store') }}" method="POST">
                        @csrf
                        <div class="form-group @error('program') has-error @enderror">
                            <label>Choisir un programme</label>
                            <select name="program" class="form-control">
                                <option value="">Selectionner un programme</option>
                                @foreach ($programs as $program)
                                <option value="{{ $program->id }}">{{ $program->libele }}</option>
                                @endforeach
                            </select>
                            @error('program')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('libele') has-error @enderror">
                            <label>Nom du domaine</label>
                            <input type="text" name="libele" class="form-control" value="{{ old('libele') }}">
                            @error('libele')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h2 class="box-title">Création d'un sous-domaine</h2>
                </div>
                <div class="box-body">
                    <form action="{{ route('admin.subdomains.store') }}" method="POST">
                        @csrf
                        <div class="form-group @error('sub_domain_domain') has-error @enderror">
                            <label>Choisir un domaine parent</label>
                            <select name="sub_domain_domain" class="form-control">
                                <option value="">Selectionner un domaine parent</option>
                                @foreach ($programs as $program)
                                <option value="" disabled>{{ $program->libele }}</option>
                                @foreach ($program->domains as $domain)
                                <option value="{{ $domain->id }}"> - {{ $domain->libele }}</option>
                                @endforeach
                                @endforeach
                            </select>
                            @error('sub_domain_domain')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('sub_domain_libele') has-error @enderror">
                            <label>Sous domaine</label>
                            <input type="text" name="sub_domain_libele" class="form-control">
                            @error('sub_domain_libele')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group"><button type="submit" class="btn btn-block btn-primary btn-sm">Enregistrer</button></div>
                    </form>
                </div>
            </div>
        </div>
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
                    <div>
                        <h4>niveaux concernés</h4>
                        @foreach ($program->niveaux as $niveau)
                            <span class="badge badge-dark">{{ $niveau->libele }}</span>
                        @endforeach
                    </div>
                    <div>
                        <h4>Domaines</h4>
                        <div class="domain-list">
                            @foreach ($program->domains as $domain)
                            <div class="domain-item">
                                <div class="d-flex justify-content-between">
                                    <span class="pl-3">{{ $domain->libele }}</span>

                                    <a href="#" class="btn btn-danger btn-sm" onclick="event.preventDefault();if(confirm('Etes vous sur de vouloir supprimer ce domaine ?')){document.getElementById('delete-domain-{{$domain->id}}').submit();}"><i class="fa fa-trash"></i></a>
                                    <form action="{{ route('admin.domains.destroy', $domain->id) }}" method="POST" id="delete-domain-{{$domain->id}}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>

                                @if (count($domain->sub_domains) > 0)
                                    @foreach ($domain->sub_domains as $subdomain)
                                    <div class="ml-5">
                                        <span class="badge badge-warning">{{ $subdomain->libele }}</span>
                                        <a href="#" class="text-danger" onclick="event.preventDefault();if(confirm('Étes vous sur de vouloir supprimer ce sous domaine ?')){document.getElementById('delete-subdomain-{{$subdomain->id}}').submit();}"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('admin.subdomains.destroy', $subdomain->id) }}" method="POST" id="delete-subdomain-{{$subdomain->id}}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            @endforeach
                        </div>
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
