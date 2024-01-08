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
                                <td class="text-success">
                                    {{ $order->status }}
                                </td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->updated_at->format('Y-m-d') }}</td>

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
