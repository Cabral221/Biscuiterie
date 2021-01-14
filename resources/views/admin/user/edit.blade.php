@extends('layouts.app', ['titlePage' => 'Modifier un administrateur'])

@section('content')
<section class="content-header">
    <h1>
        Gestion du personnel
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
        <li><a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> Personnel</a></li>
        <li class="active">Moodification d'un administrateur</li>
    </ol>
</section>

<section class="content">
    <div class="box box-success">
        <div class="box-header">
            <h3 class="box-title">Moodification de l'administrateur</h3>
        </div>
        <form action="{{ route('admin.users.update', $admin) }}" method="post" class="form">
            <div class="box-body">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @error('full_name') has-error @enderror">
                            <label for="full_name">Nom Complet</label>
                            <input type="text" name="full_name" class="form-control" id="full_name" placeholder="Nom complet" value="{{ old('full_name') ?? $admin->full_name }}">
                            @error('full_name')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('email') has-error @enderror">
                            <label for="email">Adresse Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Adresse email" value="{{ old('email') ?? $admin->email }}">
                            @error('email')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('phone') has-error @enderror">
                            <label for="phone">Numéro de Téléphone</label>
                            <input type="number" name="phone" id="phone" class="form-control" placeholder="Numéro de téléphone" value="{{ old('phone') ?? $admin->phone }}">
                            @error('phone')
                                <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_admin" @if ($admin->is_admin)  checked @endif> Super administrateur
                                </label>
                            </div>
                            <span class="help-block"><i class="fa fa-warning text-warning"></i> Si la case est cochée, il (elle) disposera de tous les droits</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</section>
@endsection
