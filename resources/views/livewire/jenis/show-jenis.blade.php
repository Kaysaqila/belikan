<div class="w-full lg:w-1/2 bg-white p-4 rounded-lg shadow-md border">
    <h3 class="text-lg font-bold mb-2">{{ $product->name }}</h3>
    <p class="text-gray-600 mb-2">Stok Tersedia: {{ $product->stock }}</p>

    @if ($product->stock > 0)
        {{-- Increment/Decrement --}}
        <div class="flex items-center gap-2 mb-4">
            <button wire:click="decrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg">-</button>
            <span class="text-lg font-semibold">{{ $quantity }}</span>
            <button wire:click="incrementQuantity" class="px-3 py-1 bg-gray-200 rounded text-lg">+</button>
        </div>

        {{-- Subtotal --}}
        <p class="font-bold text-xl text-gray-800 mb-4">
            Subtotal: Rp{{ number_format($product->price * $quantity, 0, ',', '.') }}
        </p>

        {{-- Tombol Add --}}
        <livewire:add-to-cart-button :productId="$product->id" />
    @else
        <div class="text-red-600 font-semibold mb-4">Stok habis</div>

        <p class="font-bold text-xl text-gray-800 mb-4">
            Harga: Rp{{ number_format($product->price, 0, ',', '.') }}
        </p>

        <button class="w-full px-4 py-2 bg-gray-300 text-gray-600 rounded cursor-not-allowed" disabled>
            Stok Habis
        </button>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

   <!-- Pop up berhasil ditambahkan -->
    <div id="cart-popup"
        style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; z-index:9999; background:rgba(0,0,0,0.2);"
        class="flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg px-8 py-6 flex flex-col items-center">
            <!-- Checklist hijau SVG -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mb-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <circle cx="12" cy="12" r="10" fill="#22c55e"/>
                <path stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M8 12l2.5 2.5L16 9"/>
            </svg>
            <span class="text-lg font-semibold text-gray-800">Berhasil ditambahkan ke keranjang!</span>
        </div>
    </div>
    <script>
        window.addEventListener('cart-added', function () {
            var popup = document.getElementById('cart-popup');
            popup.style.display = 'flex';
            setTimeout(function () {
                popup.style.display = 'none';
            }, 2000);
        });
    </script>
</div>