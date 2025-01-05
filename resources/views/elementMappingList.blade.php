@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Element Mapping</h2>
            <button class="btn btn-primary" onclick="window.location.href='{{ route('ElementMappingController.showAdd') }}'">Add Element Mapping</button>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Elementer Type</th>
                    <th scope="col">Frontend Type</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mappingData as $index => $mapping)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $mapping->elementor_type }}</td>
                        <td>{{ $mapping->frontend_type }}</td>
                        <td>
                            <a href="{{ route('ElementMappingController.showEdit', ['id' => $mapping->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection