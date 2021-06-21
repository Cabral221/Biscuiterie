@extends('layouts.app', ['titlePage' => 'Ajout d\'un éléve'])

@section('content')
<section class="content-header">
	<h1>
		Ajouter un éléve
	</h1>
	<ol class="breadcrumb">
		<li class=""><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> Tableau de bord</a></li>
		<li class="active"><i class="fa fa-dashboard"></i> Ajouter un éléve</li>
	</ol>
</section>

<section class="content">
	<div class="box box-primary">
		<div class="box-header">
			<h2 class="box-title">Ajouter un(e) éléve</h2>
		</div> 
		<div class="box-body">
			<h3 class="box-title">informations de l'éléve</h3>
			<form action="{{ route('admin.students.store') }}" method="post">
				@csrf
				@method('POST')
				<div class="border border-primary px-3 py-2">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group @error('classe_id') has-error @enderror">
								<label>Classe</label>
								<select class="form-control" name="classe_id">
									<option selected disabled value="">Selectonner une classe</option>
									@foreach ($niveaux as $n)
									<option disabled><b>{{ $n->libele }}</b></option>
									@foreach ($n->classes as $classe)
									<option value="{{ $classe->id }}">{{ $classe->libele }}</option>
									@endforeach
									@endforeach
								</select>
								@error('classe_id')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('kind') has-error @enderror">
								<label for="kind" class="mr-5">Genre</label>
								<label class="radio-inline">
									<input type="radio" name="kind" value="1">Masculin
								</label>
								<label class="radio-inline">
									<input type="radio" name="kind" value="0">Féminin
								</label>
								@error('kind')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('first_name') has-error @enderror">
								<label for="first_name">Prénom</label>
								<input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}">
								@error('first_name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('last_name') has-error @enderror">
								<label for="last_name">Nom</label>
								<input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}">
								@error('last_name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group @error('birthday') has-error @enderror">
								<label for="last_name">Date de naissance</label>
								<input type="date" name="birthday" id="birthday" class="form-control" value="{{ old('birthday') }}">
								@error('birthday')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('where_birthday') has-error @enderror">
								<label for="where_birthday">Lieu de naissance</label>
								<input type="text" name="where_birthday" id="where_birthday" class="form-control" value="{{ old('where_birthday') }}">
								@error('where_birthday')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('address') has-error @enderror">
								<label for="address">Adresse</label>
								<input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
								@error('address')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>					
							<div class="form-group @error('country_id') has-error @enderror">
								<label>Nationnalité</label>
								<select class="form-control" name="country_id">
									<option selected disabled value="">Selectonner la nationnalité</option>
									@foreach ($countries as $country)
										<option value="{{ $country->id }}"><b>{{ $country->name }}</b></option>
									@endforeach
								</select>
								@error('country_id')
									<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<div class="row mb-2">
					<div class="col-sm-6">
						<h4 class="box-title">Filiation du Pére ou tuteur</h3>
						<div class="border border-primary rounded px-3 py-2">
							<div class="form-group @error('father_name') has-error @enderror">
								<label for="father_name">Prénom</label>
								<input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}">
								@error('father_name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('father_phone') has-error @enderror">
								<label for="father_phone">Téléphone</label>
								<input type="number" name="father_phone" id="father_phone" class="form-control" value="{{ old('father_phone') }}">
								@error('father_phone')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('father_nin') has-error @enderror">
								<label for="father_nin">Numéro d'identification National</label>
								<input type="number" name="father_nin" id="father_nin" class="form-control" value="{{ old('father_nin') }}">
								@error('father_nin')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<h4 class="box-title">Filiation de la Mére ou tutrice</h3>
						<div class="border border-primary rounded px-3 py-2">
							<div class="form-group @error('mother_first_name') has-error @enderror">
								<label for="mother_first_name">Prénom</label>
								<input type="text" name="mother_first_name" id="mother_first_name" class="form-control" value="{{ old('mother_first_name') }}">
								@error('mother_first_name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('mother_last_name') has-error @enderror">
								<label for="mother_last_name">Nom</label>
								<input type="text" name="mother_last_name" id="mother_last_name" class="form-control" value="{{ old('mother_last_name') }}">
								@error('mother_last_name')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('mother_phone') has-error @enderror">
								<label for="mother_phone">Téléphone</label>
								<input type="number" name="mother_phone" id="mother_phone" class="form-control" value="{{ old('mother_phone') }}">
								@error('mother_phone')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
							<div class="form-group @error('mother_nin') has-error @enderror">
								<label for="mother_nin">Numéro d'identification National</label>
								<input type="number" name="mother_nin" id="mother_nin" class="form-control" value="{{ old('mother_nin') }}">
								@error('mother_nin')
								<span class="help-block">{{ $message }}</span>
								@enderror
							</div>
						</div>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<button type="submit" class="btn btn-block btn-md btn-primary">Enregistrer</button>
				</div>
			</form>
		</div>
	</div>
</section>
@endsection
