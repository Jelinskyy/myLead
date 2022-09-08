@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Products</div>
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            @foreach ($products as $product)
                            <h2 class="accordion-header" id="heading{{ $product->id }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $product->id }}" aria-expanded="false" aria-controls="collapse{{ $product->id }}">
                                    {{ $product->name }}
                                </button>
                            </h2>
                            <div id="collapse{{ $product->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $product->id }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body bg-gray">
                                    <div class="row px-3">
                                        {{ $product->description }}
                                    </div>
                                    <div class="row mt-4 px-2">
                                        <h5>Prices:</h5>
                                        <ul class="list-group list-group-flush">
                                            @foreach($product->prices as $price)
                                            <li class="list-group-item bg-transparent">{{ $price->value }}$</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
