<x-app-layout>
<html lang="id">
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

               <div class="w-full">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner h-[600px]"> <!-- Atur tinggi sesuai keinginan -->
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan1.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan2.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="3000">
                        <img src="{{ asset('images/ikan3.png') }}" class="d-block w-100 h-full object-cover" alt="...">
                    </div>
                    </div> <!-- end carousel-inner -->
                </div>
                </div>


                <div class="container mt-3">
                    <div class="d-flex align-items-center justify-content-center mb-4">
                        <hr style="flex-grow: 1; border: none; border-top: 2px solid black; margin: 0 15px;">
                        <h3 class="fw-bold mb-0">PRODUK TERLARIS</h3>
                        <hr style="flex-grow: 1; border: none; border-top: 2px solid black; margin: 0 15px;">
                    </div>

                    <div id="topProductsCarousel" class="carousel slide my-4" data-bs-ride="carousel">
                        <div class="carousel-inner">
                        @foreach ($topProducts->chunk(4) as $chunkIndex => $productChunk)
                        <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                            <div class="d-flex flex-wrap justify-content-center gap-4">
                                @foreach ($productChunk as $product)
                                <a href="{{ route('jenis.show', $product->id) }}" class="text-decoration-none">
                                    <div class="card position-relative p-3" style="width: 16rem;">
                                        {{-- Gambar Produk --}}
                                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">

                                        {{-- Badge Sold Out --}}
                                        @if ($product->stock == 0)
                                            <div class="position-absolute top-0 start-0 bg-danger text-white px-2 py-1 rounded-end">
                                                Sold Out
                                            </div>
                                        @endif

                                        {{-- Konten --}}
                                        <div class="card-body text-center">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                            <p class="card-text">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                            <p class="card-text"><small class="text-muted">Sisa stok: {{ $product->stock }}</small></p>
                                        </div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                        </div>

                        <button class="carousel-control-prev" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Sebelumnya</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Selanjutnya</span>
                        </button>
                    </div>
                </div>


                <livewire:parallax-section />
                
            </div>

              <div class="container mt-3">
                    <h3 class="mb-4 text-center fw-bold">PRODUK TERLARIS</h3>
                        <div id="topProductsCarousel" class="carousel slide my-4">
                            <div class="carousel-inner">
                                @foreach ($topProducts->chunk(4) as $chunkIndex => $productChunk)
                                    <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                                        <div class="d-flex flex-wrap justify-content-center gap-4">
                                            @foreach ($productChunk as $product)
                                            <a href="{{ route('jenis.show', $product->id) }}" class="text-decoration-none">
                                                <div class="card p-3" style="width: 16rem;">
                                                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                                                    <div class="card-body text-center">
                                                        <h5 class="card-title">{{ $product->name }}</h5>
                                                        <p class="card-text">Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                                                        <p class="card-text">
                                                            <small class="text-muted">Sisa stok: {{ $product->stock }}</small>
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Sebelumnya</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#topProductsCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Selanjutnya</span>
                        </button>
                    </div>
                </div>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
</x-app-layout>