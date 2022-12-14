@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex py-2">
                    <div class="me-auto h5 d-flex align-items-center m-0">
                        Products
                    </div>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 d-flex">
                        <div class="input-group">
                            <select class="form-select" name="order" aria-label="Default select example">
                                <option value="1" {{ (request("order") == '1' ? "selected":"") }}>default</option>
                                <option value="2" {{ (request("order") == '2' ? "selected":"") }}>by name ascend</option>
                                <option value="3" {{ (request("order") == '3' ? "selected":"") }}>by name descend</option>
                            </select>
                            <input type="search" name="search" class="form-control" placeholder="Search..." value="{{request("search") ?? ""}}" aria-label="Search">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    @auth
                    <div>
                        <a href="{{ route('product.create') }}" class="btn btn-success">Add Product</a>
                    </div>
                    @endauth
                </div>
                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
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
                                    @auth
                                    <div class="row">
                                        <div class="col-12">
                                            <form method="POST" action="{{ route('product.destroy', ['product' => $product]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger float-end mx-1 my-2" value="Delete">
                                            </form>
                                            <a href="{{ route('price.create', ['product' => $product]) }}" class="btn btn-success float-end mx-1 my-2">Add price</a>
                                            <a href="{{ route('product.edit', ['product' => $product]) }}" class="btn btn-success float-end mx-1 my-2">Edit</a>
                                        </div>
                                    </div>
                                    @endauth
                                    <div class="row px-3">
                                        {{ $product->description }}
                                    </div>
                                    <div class="row mt-4 px-2">
                                        <div class="h5">Prices:</div>
                                        <ul class="list-group list-group-flush">
                                            @foreach($product->prices as $price)
                                            <li class="list-group-item bg-transparent d-flex align-items-center justify-content-between">
                                                {{ $price->value }}$
                                                @auth
                                                <div class="d-flex">
                                                    <a href="{{ route('price.edit', ['price' => $price]) }}" class="btn btn-success mx-1 my-2">Edit</a>
                                                    <form method="POST" action="{{ route('price.destroy', ['price' => $price]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="submit" class="btn btn-danger float-end mx-1 my-2" value="Delete">
                                                    </form>
                                                </div>
                                                @endauth
                                            </li>
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
