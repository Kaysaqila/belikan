<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            duration: 500,
        });
    });
</script>

<div>
   <section class="relative w-full h-[500px] bg-cover bg-center overflow-hidden pb-16"
    style="background-image: url('{{ asset('images/wave-haikei 1 (1).png') }}');">

    <div class="absolute top-0 left-60 h-full flex items-center justify-center pr-10 z-0">
        <img src="{{ asset('images/image 7.png') }}" alt="Ikan Cupang" class="h-[400px] object-contain">
    </div>

    <!-- Teks -->
    <div class="absolute top-1/3 right-40  z-10">
        <h1 class="text-blavk text-4xl font-bold leading-tight mb-4">
            Biar Ikan Betah <br />
            Kasih Aquarium <br />
            Terbaik!
        </h1>
        <a href="#" class="bg-white text-[#00ADEF] font-semibold px-5 py-2 rounded-full shadow hover:bg-blue-100">
            Buy Now!
        </a>
    </div>

</section>
    <!-- Sort Dropdown -->
    <form method="GET" id="sortForm" class="block mt-4">
        <div class="mb-3">
            <select name="sort" id="sort"
                class="bg-black text-white uppercase px-4 py-2 rounded cursor-pointer ml-20"
                onchange="document.getElementById('sortForm').submit();">
                <option value="">SORT BY:</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
        </div>
    </form>

    <!-- Products Grid -->
    <div class="grid grid-cols-4 gap-8 m-4 p-4">
        @forelse($products as $product)
            <a href="{{ route('aquarium.show', $product->id) }}" class="block">
                <div class="zoom bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 dark:bg-gray-800 dark:border-gray-700 m-2 p-2 hover:shadow-lg transition-shadow" 
                    data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 text-center">
                        <h3 class="text-lg font-semibold text-black-800 dark:text-black-100">{{ $product->name }}</h3>
                        <p class="text-sm text-black-600 dark:text-black-300 mt-2">Price: Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="text-sm text-black-600 dark:text-black-300">Stock: {{ $product->stock }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                Tidak ada produk dalam kategori ini.
            </div>
        @endforelse
    </div>

    <!-- Footer -->
    <footer class="bg-black text-gray-400 text-sm p-6 grid grid-cols-4 gap-4">
        <div>
            <h3 class="font-semibold text-white">Tentang Kami</h3>
            <p>Cerita Kami</p>
            <p>Siapa BeliKAN?</p>
            <p>Karier</p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Layanan</h3>
            <p>Belanja Online</p>
            <p>Pengiriman Cepat</p>
            <p>Customer Support</p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Sosial Media</h3>
            <p class="flex items-center gap-2">
                <i class="bi bi-facebook"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-tiktok"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-instagram"></i>
                @belikan_official
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-youtube"></i>
                BELIKAN_official
            </p>
        </div>
        <div>
            <h3 class="font-semibold text-white">Kontak Kami</h3>
            <p class="flex items-center gap-2">
                <i class="bi bi-geo-alt-fill"></i>
                Jl. Kenangan
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-telephone-fill"></i>
                +62 85858585858
            </p>
            <p class="flex items-center gap-2">
                <i class="bi bi-envelope-fill"></i>
                hallo@belikan.id
            </p>
        </div>
    </footer>
</div>