@extends('transactions.app')
@section('content')
<div class="card">
	<div class="card-header"><h2>Transaction Detail</h2></div>
		<div class="card-body">
		<div class="row justify-content-start">
				<div class="col-4">
					<label>ID</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->id }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label>Sender</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->payor_name }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label>Sender Account</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->payor_acc }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label>Recipient</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->payee_name }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label>Recipient Account</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->payee_acc }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label for="amount">Amount</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->amount }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label for="description">Description</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->description }}</label>
				</div>
			</div>
			<br>
			<div class="row justify-content-start">
				<div class="col-4">
					<label for="description">Created at</label>
				</div>
				<div class="col-8">
					<label>{{ $transaction->created_at }}</label>
				</div>
			</div>
			<br>
		</div>
    </hr>
	</div>
</div>
@endsection