@extends('layouts.app', ['titlePage' => 'Administration'])

@section('content')
<section class="content-header">
    <h1>
        Blank page <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        @foreach ($niveaux as $k => $niveau)
            <div class="col-md-4 col-sm-6 col-xs-12">
                <!-- small box -->
                <div class="small-box bg-{{$bgColors[$k]}}">
                    <div class="inner">
                        <h3>{{$niveau->libele}} : {{ $niveau->studentsCount() }}</h3>
                        @foreach ($niveau->classes as $c)
                            <p>{{$c->libele}} : {{$c->students->count()}}</p>
                        @endforeach
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
            </div>
            
        @endforeach
    </div>
    
    <h2>Ajouter un(e) éléve</h2>
    <form action="{{ route('admin.students.store') }}" method="post">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">informations de l'éléve</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group @error('classe_id') has-error @enderror">
                            <label>Classe</label>
                            <select class="form-control" name="classe_id">
                                <option value="">Selectonner une classe</option>
                                @foreach ($classes as $classe)
                                <option value="{{ $classe->id }}">
                                    {{ $classe->libele }}
                                </option>
                                @endforeach
                            </select>
                            @error('classe_id')
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
                        <div class="form-group @error('birthday') has-error @enderror">
                            <label for="last_name">Date de naissance</label>
                            <input type="date" name="birthday" id="birthday" class="form-control" value="@if( old('birthday') !== null) {{ old('birthday')->format('Y-m-d') }} @endif">
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
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Filiation des parents</h3>
                    </div>
                    <div class="box-body">
                        <div class="form-group @error('father_name') has-error @enderror">
                            <label for="father_name">Prénom du père</label>
                            <input type="text" name="father_name" id="father_name" class="form-control" value="{{ old('father_name') }}">
                            @error('father_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('father_phone') has-error @enderror">
                            <label for="father_phone">Téléphone du pére</label>
                            <input type="number" name="father_phone" id="father_phone" class="form-control" value="{{ old('father_phone') }}">
                            @error('father_phone')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <hr>
                        <div class="form-group @error('mother_first_name') has-error @enderror">
                            <label for="mother_first_name">Prénom de la mère</label>
                            <input type="text" name="mother_first_name" id="mother_first_name" class="form-control" value="{{ old('mother_first_name') }}">
                            @error('mother_first_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('mother_last_name') has-error @enderror">
                            <label for="mother_last_name">Nom de la mère</label>
                            <input type="text" name="mother_last_name" id="mother_last_name" class="form-control" value="{{ old('mother_last_name') }}">
                            @error('mother_last_name')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group @error('mother_phone') has-error @enderror">
                            <label for="mother_phone">Téléphone de la mère</label>
                            <input type="number" name="mother_phone" id="mother_phone" class="form-control" value="{{ old('mother_phone') }}">
                            @error('mother_phone')
                            <span class="help-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Enregistrer</button>
        </div>
    </form>
</section>
@endsection