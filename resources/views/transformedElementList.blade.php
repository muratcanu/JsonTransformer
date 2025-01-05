@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Transofrmed Contents</h2>
            <button class="btn btn-primary" onclick="window.location.href='{{ route('TransformedElementController.showAdd') }}'">Transform Content</button>
        </div>
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Index</th>
                    <th scope="col">Source Id</th>
                    <th scope="col">Transformed Content</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($contentData as $index => $content)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $content->source_id }}</td>
                        <td>{{ $content->transformed_content }}</td>
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