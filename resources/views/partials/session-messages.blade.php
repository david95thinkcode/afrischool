@if (session('status'))
	<div class="alert alert-success text-center" role="alert">
		{{ session('status') }}
	</div>

@elseif (session('info'))
	<div class="alert alert-info text-center" role="alert">
		{{ session('info') }}
	</div>

@elseif (session('warning'))
	<div class="alert alert-warning text-center" role="alert">
		{{ session('warning') }}
	</div>

@elseif (session('danger'))
	<div class="alert alert-danger text-center" role="alert">
		{{ session('danger') }}
	</div>

@elseif ($errors->any())
	<div class="alert alert-danger" role="alert">
		<ul>
			@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@else
@endif