@if (session('status'))
<div class="alert alert-success text-center" role="alert">
	{{ session('status') }}
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