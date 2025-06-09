<div class="w-full lg:w-1/2 bg-white p-4 rounded-lg shadow-md border">
    <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
    <p class="text-gray-600 mb-2">Stok Tersedia: {{ $product->stock }}</p>

    @if ($product->stock > 0)
        {{-- Increment/Decrement dengan disable --}}
        <div class="flex items-center gap-2 mb-4">
            <button wire:click="decrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg"
                {{ $quantity <= 1 ? 'disabled' : '' }}>-</button>
            <span class="text-lg font-semibold">{{ $quantity }}</span>
            <button wire:click="incrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg"
                {{ $quantity >= $product->stock ? 'disabled' : '' }}>+</button>
        </div>

        {{-- Subtotal --}}
        <p class="font-bold text-xl text-gray-800 mb-4">
            Subtotal: Rp{{ number_format($product->price * $quantity, 0, ',', '.') }}
        </p>

        {{-- Tombol Add --}}
        <button wire:click="addToCart"
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded mb-2">
            + Keranjang
        </button>
    @else
        <div class="text-red-600 font-semibold mb-4">Stok habis</div>

        <p class="font-bold text-xl text-gray-800 mb-4">
            Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
        </p>

        <button class="w-full px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed" disabled>
            Stok Habis
        </button>
    @endif

    {{-- Pesan error --}}
    @if (session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif
 
</div>
