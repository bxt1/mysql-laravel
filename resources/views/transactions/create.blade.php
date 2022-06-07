@extends('transactions.app')
@section('content')
<div class="card">
	<div class="card-header"><h2>Transfer Money</h2></div>
	<div class="alert alert-warning" role="alert">
		<strong>Warning!</strong> 
		<p>This page simulates an eBanking transaction and update to 'transactions' table. It does not imply how real eBanking works!</p>
	</div>
	<div class="card-body">
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		<form action="{{ url('transaction') }}" method="post">
			{!! csrf_field() !!}
			<div class="row justify-content-start">
				<div class="col-1">
					<label>Sender</label>
				</div>
				<div class="col-11">
					<select name="payor_acc">
						@foreach ($accounts as $item)
							<option value="{{ $item->id }}" @selected(old('payor_acc') == $item)>
								{{ $item->name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-1">
					<label>Recipient</label>
				</div>
				<div class="col-11">
					<select name="payee_acc">
						@foreach ($accounts as $item)
							<option value="{{ $item->id }}" @selected(old('payee_acc') == $item)>
								{{ $item->name }}
							</option>
						@endforeach
					</select>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-1">
					<label for="amount">Amount</label>
				</div>
				<div class="col-11">
					<input  type="number" step="any" name="amount" id="amount" class="form-control" required></br>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-1">
					<label for="description">Description</label>
				</div>
				<div class="col-11">
					<input  type="text" name="description" id="description" class="form-control" required></br>
				</div>
			</div>
			<br>
			<input type="submit" value="Save" class="btn btn-success"></br>
		</form>
	</div>
</div>
@endsection