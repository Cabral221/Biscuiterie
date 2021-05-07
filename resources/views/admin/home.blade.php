@extends('layouts.app', ['titlePage' => 'Administration'])

@section('content')
<section class="content-header">
	<h1>
		Tableau de bord <small>statistiques</small>
	</h1>
	<ol class="breadcrumb">
		<li class="active"><i class="fa fa-dashboard"></i> Tableaude bord</li>
	</ol>
</section>

<section class="content">
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4">
					L' <span class="text-primary"> {{ config('app.name') }}</span> compte 
					<h2 class="text-danger display-4"><b>{{ $totalStudents }}</b></h2>
					<span>éléve(s)</span>
				</div>
				<div class="col-sm-4 text-primary">
					<h4>Garçon(s)</h4>
					<h3 class="font-weight-bold">{{ $totalBoys }}</h3>
					<h4>{{ $totalBoysPercent }} %</h4>
					<div class="progress mt-1 mb-0" style="height: 7px;">
						<div class="progress-bar bg-primary" role="progressbar" style="width: {{$totalBoysPercent}}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
				<div class="col-sm-4 text-pink">
					<h4>Fille(s)</h4>
					<h3 class="font-weight-bold">{{ $totalGirls }}</h3>
					<h4>{{ $totalGirlsPercent }} %</h4>
					<div class="progress mt-1 mb-0" style="height: 7px;">
						<div class="progress-bar bg-pink" role="progressbar" style="width: {{$totalGirlsPercent}}%" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<hr>
	@foreach ($niveaux as $niveau)
	<div class="card border-dark mb-3">
		<div class="card-body">
			<div class="d-flex align-items-center justify-content-between">
				<h1 class="card-title"><b>{{ $niveau->libele }}</b> : {{ $niveau->studentsCount() }} éléve(s)</h2>
				<div class="d-flex">
					@foreach ($niveau->classes as $classe)
					<div class="card border-primary m-2" style="width: 250px;">
						<div class="card-header">{{ $classe->user->full_name }}</div>
						<a href="{{ route('admin.classes.show', $classe) }}" class="text-primary"><h5 class="text-center">{{ $classe->libele }} : {{ $classe->total }}</h5></a>
						<div class="card-body d-flex justify-content-between">
							<div class="border-top border-primary text-primary text-center" style="width: 100px;">
								<span class="">{{ $classe->boy_count }}</span>
								<p>Garçons</p>
							</div>
							<div class="border-top border-pink text-pink text-center" style="width: 100px;">
								<span>{{ $classe->girl_count }}</span>
								<p>Filles</p>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
	@endforeach
</section>
@endsection
