@extends('transactions.app')
@section('content')
<div class="card">
  <div class="card-header"><h2>Edit Transaction</h2></div>
  <div class="alert alert-warning" role="alert">
		<strong>Warning!</strong> 
		<p>This form modifies transaction's detail only. The sender and recipient's balance in 'bank_accounts' table is unchanged.</p>
	</div>
  <div class="card-body">
      
      <form action="{{ url('transaction/' .$transaction->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$transaction->id}}" id="id" />
        <label>Sender Account</label></br>
        <input type="text" name="payor_acc" id="payor_acc" value="{{$transaction->payor_acc}}" class="form-control"></br>
        <label>Recipient Account</label></br>
        <input type="text" name="payee_acc" id="payee_acc" value="{{$transaction->payee_acc}}" class="form-control"></br>
        <label>Amount</label></br>
        <input type="text" name="amount" id="amount" value="{{$transaction->amount}}" class="form-control"></br>
		    <label>Description</label></br>
        <input type="text" name="description" id="description" value="{{$transaction->description}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>
@endsection