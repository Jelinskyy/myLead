@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add price to: {{ $product->name }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('price.store', ['product' => $product]) }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="value" class="col-md-4 col-form-label text-md-end">Price value</label>

                            <div class="col-md-6">
                                <input id="value" type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="value" autofocus>

                                @error('value')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Confirm
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
