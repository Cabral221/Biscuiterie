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
                <div class="box-header text-center">
                    <h3 class="box-title">Programme : <span class="text-primary">{{ $program->libele }}</span></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="text-center">
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
                                    <span class="pl-3">
                                        <div>{{ $domain->libele }}</div>
                                        @if (!$domain->haveSubDomain() && $domain->activities->count() > 0)
                                            @foreach ($domain->activities as $activity)
                                                <div class="ml-3 bg-white p-2">
                                                    <a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault();if(confirm('Étes vous sùr de vouloir supprimer cette matière ?')){document.getElementById('form-delete-activity-{{$activity->id}}').submit();}"><i class="fa fa-trash"></i></a> - ( / {{ $activity->dividente }} ) {{ $activity->libele }}
                                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="post" id="form-delete-activity-{{$activity->id}}" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                            @endforeach
                                        @endif
                                    </span>

                                    <span>
                                        @if (!$domain->haveSubDomain())
                                            <button type="button" class="btn btn-xs btn-primary" title="Ajouter" data-toggle="modal" data-target="#modal-domain-add-activity-{{$domain->id}}"><i class="fa fa-plus"></i></button>
                                            <div class="modal modal-xl fade" id="modal-domain-add-activity-{{$domain->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.activities.store') }}" method="POST">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                                <h3 class="modal-title">Ajouter une matiére</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3>Programme : 
                                                                    <span class="badge badge-primary">{{ $domain->program->libele }}</span>
                                                                </h3>
                                                                <h5>Niveau : 
                                                                    @foreach ($domain->program->niveaux as $niveau)
                                                                        <span class="bagde badge-pill badge-primary">{{ $niveau->libele }}</span>    
                                                                    @endforeach
                                                                </h5>
                                                                
                                                                @csrf
                                                                @method('POST')
                                                                <input type="text" name="activitable_type" value="{{ get_class($domain) }}" class="d-none">
                                                                <input type="text" name="activitable_id" value="{{ $domain->id }}" class="d-none">
                                                                <div class="form-group">
                                                                    <label>Domaine</label>
                                                                    <select name="activitable_id" class="form-control" disabled="disabled">
                                                                        <option selected>{{ $domain->libele }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group @error('libele') has-error @enderror">
                                                                    <label>Libelé de la matière</label>
                                                                    <input type="text" name="libele" class="form-control">
                                                                    @error('libele')
                                                                        <span class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group @error('dividente') has-error @enderror">
                                                                    <label>Dividente</label>
                                                                    <input type="number" name="dividente" class="form-control">
                                                                    @error('libele')
                                                                        <span class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>

                                                        </form>  
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
    
                                        <a href="#" class="btn btn-danger btn-xs" title="Supprimer" onclick="event.preventDefault();if(confirm('Etes vous sur de vouloir supprimer ce domaine ?')){document.getElementById('delete-domain-{{$domain->id}}').submit();}"><i class="fa fa-trash"></i></a>
                                        <form action="{{ route('admin.domains.destroy', $domain->id) }}" method="POST" id="delete-domain-{{$domain->id}}" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </span>
                                </div>

                                @if ($domain->haveSubDomain())
                                    @foreach ($domain->sub_domains as $subdomain)
                                    <div class="ml-5 my-2 d-flex justify-content-between">
                                        <div class="ml-3 p-2">
                                            <div>{{ $subdomain->libele }}</div>
                                            @if ($subdomain->activities->count() > 0)
                                                @foreach ($subdomain->activities as $activity)
                                                    <div class="ml-3 bg-white p-2">
                                                    <a href="#" class="btn btn-xs btn-danger" title="Supprimer" onclick="event.preventDefault();if(confirm('Étes vous sùr de vouloir supprimer cette matière ?')){document.getElementById('form-delete-activity-{{$activity->id}}').submit();}"><i class="fa fa-trash"></i></a> - ( / {{ $activity->dividente }} ) {{ $activity->libele }}
                                                    <form action="{{ route('admin.activities.destroy', $activity->id) }}" method="post" id="form-delete-activity-{{$activity->id}}" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </div>
                                                @endforeach
                                            @endif
                                        </div>
                                        
                                        <div>
                                            <button type="button" class="btn btn-xs btn-primary" data-toggle="modal" title="Ajouter" data-target="#modal-subdomain-add-activity-{{$subdomain->id}}"><i class="fa fa-plus"></i></button>
                                            <div class="modal modal-xl fade" id="modal-subdomain-add-activity-{{$subdomain->id}}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form action="{{ route('admin.activities.store') }}" method="POST">

                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span></button>
                                                                <h3 class="modal-title">Ajouter une matiére</h3>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h3>Programme : 
                                                                    <span class="badge badge-primary">{{ $subdomain->domain->program->libele }}</span>
                                                                </h3>
                                                                <h5>Niveau : 
                                                                    @foreach ($subdomain->domain->program->niveaux as $niveau)
                                                                        <span class="bagde badge-pill badge-primary">{{ $niveau->libele }}</span>    
                                                                    @endforeach
                                                                </h5>
                                                                
                                                                @csrf
                                                                @method('POST')
                                                                <input type="text" name="activitable_type" value="{{ get_class($subdomain) }}" class="d-none">
                                                                <input type="text" name="activitable_id" value="{{ $subdomain->id }}" class="d-none">
                                                                <div class="form-group">
                                                                    <label>Domaine</label>
                                                                    <select class="form-control" disabled="disabled">
                                                                        <option selected>{{ $subdomain->domain->libele }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Sous Domaine</label>
                                                                    <select class="form-control" disabled="disabled">
                                                                        <option selected>{{ $subdomain->libele }}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group @error('libele') has-error @enderror">
                                                                    <label>Libelé de la matière</label>
                                                                    <input type="text" name="libele" class="form-control">
                                                                    @error('libele')
                                                                        <span class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group @error('dividente') has-error @enderror">
                                                                    <label>Dividente</label>
                                                                    <input type="number" name="dividente" class="form-control">
                                                                    @error('libele')
                                                                        <span class="help-block">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                            </div>

                                                        </form>  
                                                    </div>
                                                </div>
                                            </div>
    
                                            <a href="#" class="btn btn-xs btn-danger" title="Supprimer" onclick="event.preventDefault();if(confirm('Étes vous sur de vouloir supprimer ce sous domaine ?')){document.getElementById('delete-subdomain-{{$subdomain->id}}').submit();}"><i class="fa fa-trash"></i></a>
                                            <form action="{{ route('admin.subdomains.destroy', $subdomain->id) }}" method="POST" id="delete-subdomain-{{$subdomain->id}}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </div>
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
