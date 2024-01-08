@extends('dashboard.layouts.layout')

@section('content')
    <div class="container-fluid  pl-0">
        <div class="row">
            <div class="col-12">
                @include('dashboard.layouts.notification')
            </div>
            <div class="col-sm-12 col-md-4 col-lg-2">
                @include('dashboard.layouts.sidebar')
            </div>
            <div class="col-sm-12 col-md-8 col-lg-10">
                @include('dashboard.layouts.navbar')
                <table id="myTable" class="display ">
                    <thead>
                        <tr>
                            <th>Order number</th>
                            <th>Image</th>
                            <th>Client name</th>
                            <th>Product name</th>
                            <th>quantity</th>
                            <th>Payment status</th>
                            <th> Status</th>
                            <th>price</th>
                            <th>date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->order_number }}</td>
                                <td>
                                    @if ($order->product->type == 'product')
                                        <img src="{{ asset('public/assets/images/Products') }}/{{ $order->product->photo }}"
                                            alt="{{ $order->product->name }}" class="img-fluid zoom" style="max-width:80px">
                                    @else
                                        <img src="{{ asset('public/assets/images/products-upload') }}/{{ $order->product->photo }}"
                                            alt="{{ $order->product->name }}" class="img-fluid zoom" style="max-width:80px">
                                    @endif
                                </td>
                                @if ($order->user)
                                    <!-- Check if the user relationship exists -->
                                    <td>{{ $order->user->name }}</td>
                                @else
                                    <td>User not found</td>
                                @endif
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->quantity }}</td>
                                <td>{{ $order->payment_status }}</td>
                                <td>
                                    <form method="POST" action="{{ route('orders.update', $order->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()">
                                            <option value="" selected disabled> Status</option>
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="processing"
                                                {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                Processing
                                            </option>
                                            <option value="completed"
                                                {{ $order->status == 'completed' ? 'selected' : '' }}>
                                                Completed
                                            </option>
                                            <option value="cancelled"
                                                {{ $order->status == 'cancelled' ? 'selected' : '' }}>
                                                Cancelled
                                            </option>
                                        </select>

                                    </form>
                                </td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td class="text-center">
                                    <form method="POST" class="d-inline-block"
                                        action="{{ route('order-destroy', $order->id) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm dltBtn" data-id='' data-toggle="tooltip"
                                            data-placement="bottom" title="Delete">

                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();

        });
    </script>
@endsection
