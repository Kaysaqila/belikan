<script>
    document.addEventListener("DOMContentLoaded", function () {
        AOS.init({
            duration: 500,
        });
    });
</script>

<div>
<section 
    class="relative w-full h-[500px] bg-center overflow-hidden pb-16"
    style="background-image: url('{{ asset('images/Group 343.png') }}');
           background-size: 1600px 800px;
           background-repeat: no-repeat;
           background-position: center;">
</section>


<form method="GET" id="sortForm" class="mt-8">
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

<div class="grid grid-cols-4 gap-8 m-4 p-4">
    @forelse($products as $product)
        <a href="{{ route('jenis.show', $product->id) }}" 
           class="block {{ $product->stock <= 0 ? 'pointer-events-none' : '' }}">
            <div 
                class="zoom bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 m-2 p-2 hover:shadow-lg transition-shadow {{ $product->stock <= 0 ? 'opacity-50 grayscale' : '' }}"
                data-aos="fade-up" data-aos-anchor-placement="center-bottom">
                
                {{-- Gambar Produk + Badge --}}
                <div class="relative w-full h-40 bg-gray-100 flex items-center justify-center">
                    @if ($product->stock == 0)
                        <div class="absolute top-2 left-2 z-10 bg-red-700 text-white text-xs font-bold px-3 py-1 rounded shadow">
                            SOLD OUT
                        </div>
                    @endif
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>

                {{-- Informasi Produk --}}
                <div class="p-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-sm text-gray-600 mt-2">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-600">Stock: {{ $product->stock }}</p>
                </div>
            </div>
        </a>
    @empty
        <div class="col-span-full text-center text-gray-500">
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