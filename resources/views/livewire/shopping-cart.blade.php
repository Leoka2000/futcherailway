<div>
    <h1>Shopping Cart</h1>
    <ul>
        @foreach ($cartItems as $item)
            <li>
                {{ $item['name'] }} - ${{ $item['price'] }}
            </li>
        @endforeach
    </ul>
</div>

