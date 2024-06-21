@extends('layouts.navbar')

@section('title', 'Sales Report')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/sales.css') }}">
@endpush

@section('content')
    <div class="container">
        <h1>Sales Reports</h1>
        <div class="form-group">
            <label for="orderSelect">Ordenar por:</label>
            <select class="form-control" id="orderSelect">
                <option value="created_at">Fecha</option>
                <option value="total">Precio</option>
                <option value="quantity">Cantidad</option>
            </select>
        </div>
        <table class="sales-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody id="salesTableBody">
                @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->created_at }}</td>
                    <td>{{ $sale->total }}</td>
                    <td>{{ $sale->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('js/sales.js') }}"></script>
@endsection