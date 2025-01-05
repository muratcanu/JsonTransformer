@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2 class="text-center mb-4">Paste Content to Transform</h2>
        <form action="{{ route('TransformedElementController.add') }}" method="POST">
            @csrf  <!-- CSRF token for security -->
            <div class="mb-3">
                <label for="sourceId" class="form-label">Source Id</label>
                <input type="text" class="form-control" id="sourceId" name="sourceId" placeholder="Enter source id" required>
            </div>
            <div class="mb-3">
                <label for="rawContent" class="form-label">Content</label>
                <textarea class="form-control" id="rawContent" name="rawContent" rows="25" placeholder="Paste content to transform here"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    @if(isset($transformedData))
    <div class="alert alert-success mt-4">
        <pre>{{ json_encode($transformedData, JSON_PRETTY_PRINT) }}</pre>
    </div>
    @endif
@endsection