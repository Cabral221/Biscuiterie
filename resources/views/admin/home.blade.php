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
	<div class="row">
		@foreach ($niveaux as $k => $niveau)
		<div class="col-md-4 col-sm-6 col-xs-12">
			<!-- small box -->
			<div class="small-box bg-{{$bgColors[$k]}}">
				<div class="inner">
					<div class="d-flex align-items-center">
						<h3>{{$niveau->libele}} : {{ $niveau->studentsCount() }} </h3>
						<span> éleve(s)</span>
					</div>
					@foreach ($niveau->classes as $c)
					<p>{{$c->libele}} : {{$c->total}} éléve(s)</p>
					@endforeach
				</div>
				<div class="icon">
					<i class="ion ion-pie-graph"></i>
				</div>
			</div>
		</div>
		
		@endforeach
	</div>
	
</section>
@endsection
