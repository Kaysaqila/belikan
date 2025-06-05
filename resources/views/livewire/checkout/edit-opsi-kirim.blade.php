<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-[400px]">
        <div class="p-4">
                <h3 class="font-semibold mb-2 text-black">PILIH JASA PENGIRIMAN</h3>

                @foreach ($shippingOptions as $key => $option)
                    <div wire:click="selectOption('{{ $key }}')" class="cursor-pointer border rounded p-3 mb-2 {{ $selectedOption === $key ? 'bg-blue-100' : 'bg-white' }}">
                        <div class="font-bold text-gray-900">{{ $option['label'] }} Rp {{ number_format($option['price'], 0, ',', '.') }}</div>
                        <div class="text-sm text-gray-700">Garansi Tiba: {{ $option['guarantee'] }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-end gap-2">
                <button wire:click="$dispatch('closeOpsiKirim')" class="px-4 py-2 bg-gray-200 rounded">Nanti</button>
                <button wire:click="confirmSelection" class="px-4 py-2 bg-blue-500 text-white rounded">OKE</button>
            </div>
        </div>
    </div>
</div>