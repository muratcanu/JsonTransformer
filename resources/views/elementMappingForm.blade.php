@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center">Add Element Mapping</h1>
        <form method="POST" action="{{ route('ElementMappingController.add') }}">
            @csrf <!-- Laravel CSRF token for security -->
            <div class="mb-3">
                <label for="elementorType" class="form-label">Elementor Type</label>
                <input type="text" class="form-control" id="elementorType" name="elementorType" placeholder="Enter elementor type" required>
            </div>
            <div class="mb-3">
                <label for="frontendType" class="form-label">Frontend Type</label>
                <input type="text" class="form-control" id="frontendType" name="frontendType" placeholder="Enter frontend type" required>
            </div>
            <div class="mb-3">
                <label for="settingsMapper" class="form-label">Settings Mapper</label>
                <textarea class="form-control" id="settingsMapper" name="settingsMapper" rows="25" placeholder="Enter settings mapper" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
