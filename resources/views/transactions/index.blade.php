@extends('transactions.app')
@section('content')
    <div class="container">
		@if(Session::has('success'))
			<div class="alert alert-success alert-dismissible fade show">
				{{Session::get('success')}}
			</div>
		@endif
		
        <div class="row">
 
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>All Transactions</h2>
                    </div>
                    <div class="card-body">
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction ID</th>
										<th>Sender</th>
                                        <th>Sender Account</th>
										<th>Recipient</th>
                                        <th>Recipient Account</th>
                                        <th>Amount</th>
										<th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($transactions as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->payor_name }}</td>
                                        <td>{{ $item->payor_acc }}</td>
										<td>{{ $item->payee_name }}</td>
                                        <td>{{ $item->payee_acc }}</td>
										<td>{{ $item->amount }}</td>
                                        <td>
                                            <a href="{{ url('/transaction/' . $item->id) }}" title="View Transaction">
												<button class="btn btn-info btn-sm">
													<i class="bi bi-eye"></i> View
												</button></a>
											
                                            <a href="{{ url('/transaction/' . $item->id . '/edit') }}" title="Edit Transaction">
												<button class="btn btn-primary btn-sm">
													<i class="bi bi-pencil"></i> Edit
												</button></a>

                                            <form method="POST" action="{{ url('/transaction' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Transaction" onclick="return confirm(&quot;Confirm delete?&quot;)">
													<i class="bi bi-trash"></i> Delete
												</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
						<a href="{{ url('/transaction/create') }}" class="btn btn-success btn-sm" title="New Transaction">
							<i class="bi bi-plus"></i> New Transaction
                        </a>
                        <br/>
					</div>
                </div>
            </div>
        </div>
    </div>
@endsection