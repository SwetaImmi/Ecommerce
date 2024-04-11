@extends('home.layout.app')
@section('content')
<hr>
<hr>
<hr><br><br>

<!-- aklert -->
<!-- @if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<strong>{{ $message }}</strong>
</div>
@endif


@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<strong>{{ $message }}</strong>
</div>
@endif -->

<!-- alert -->
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-body">
					<div class="row">
						@foreach($plans as $plan)
						<div class="col-md-6">
							<div class="card mb-3">
								<div class="card-header">
									${{ $plan->price }} / {{ $plan->slug }}
								</div>
								<div class="card-body">
									<h5 class="card-title">{{ $plan->name }}</h5>
									<p class="card-text">Please Select Plan</p>
									<a href="{{ route('plans.show', $plan->id) }}" class="btn btn-primary pull-right">Choose</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection