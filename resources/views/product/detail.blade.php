@extends('layouts.app')

@section('content')
<div>
    <h1>{{ $product->name }}</h1>
    <p>{{ $product->description }}</p>
    <p>Price: ${{ $product->price }}</p>
    <p>Size: {{ $product->size }}</p>
    <p>Category: {{ $product->category->name }}</p>
    <img src="{{ $product->image[0] }}" alt="{{ $product->name }}">
</div>
@endsection