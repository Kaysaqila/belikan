<?php

namespace App\Livewire\Checkout;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;

class CheckoutComponent extends Component
{
    public $selectedProducts = [];
    public $total = 0;
    public $voucherCode;
    public $discount = 0;
    public $totalAfterDiscount = 0;
    public bool $showEditPayment = false;
    public bool $showEditAddress = false;
    public bool $showVoucher = false;
    public $paymentMethod;
    public $voucherApplied = false; // opsional, kalau mau tandai berhasil atau belum

    public $shippingAddress, $shippingNumber, $shippingName;

    protected $listeners = [
        'paymentMethodUpdated' => 'updatePaymentMethod', //update metode pembayaran
        'closePaymentModal' => 'closePaymentModal',
        'closeEditAddressModal' => 'closeEditAddressModal',
        'closeVoucher' => 'closeVoucher',
        'addressUpdated' => 'refreshShippingData',
        'voucherApplied' => 'handleVoucherApplied', //update harga setelah ada voucher
    ];

    public function mount()
    {
        $user = Auth::user();

        // Cek apakah user sudah punya shipping address
        $shipping = ShippingAddress::where('user_id', $user->id)->latest()->first();

        // Pakai shipping address kalau ada, fallback ke user
        $this->shippingAddress = $shipping?->address ?? $user->address;
        $this->shippingNumber = $shipping?->phone_number ?? $user->phone_number;
        $this->shippingName = $shipping?->name ?? $user->name;

        $selectedCartIds = session('selected_cart_ids', []);
        $this->selectedProducts = Cart::with('product')
            ->whereIn('id', $selectedCartIds)
            ->where('user_id', $user->id)
            ->get();

        // Cek apakah isi keranjang berubah
        $lastCartIds = session('last_cart_ids', []);
        if ($selectedCartIds !== $lastCartIds) {
            session()->forget(['voucher_code', 'voucher_discount']); // Hapus voucher
        }

        // Simpan daftar keranjang terbaru
        session(['last_cart_ids' => $selectedCartIds]);

        $this->total = $this->selectedProducts->sum(fn ($item) => $item->product->price * $item->quantity);
        $this->voucherCode = session('voucher_code', null);
        $this->discount = session('voucher_discount', 0);
        $this->totalAfterDiscount = $this->total - $this->discount;
    }

    public function refreshShippingData()
    {
        $user = Auth::user();
        $shipping = ShippingAddress::where('user_id', $user->id)->latest()->first();
        
        $this->shippingAddress = $shipping?->address ?? $user->address;
        $this->shippingNumber = $shipping?->phone_number ?? $user->phone_number;
        $this->shippingName = $shipping?->name ?? $user->name;
    }

    public function placeOrder()
    {
        $selectedCartIds = session('selected_cart_ids', []);
        $voucherCode = session('voucher_code');
        $voucherDiscount = session('voucher_discount', 0);

        $cartItems = Cart::whereIn('id', $selectedCartIds)->get();

        if ($cartItems->isEmpty()) {
            session()->flash('error', 'Tidak ada produk yang dipilih.');
            return;
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $total -= $voucherDiscount;

        // Buat Order
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_amount' => $total,
            'voucher_code' => $voucherCode,
            'voucher_discount' => $voucherDiscount,
            'status' => 'pending',
        ]);

        // Cari atau buat shipping address
        $shipping = ShippingAddress::where('user_id', Auth::id())
            ->latest()
            ->first();

        if ($shipping) {
            // Update dengan order_id
            $shipping->update(['order_id' => $order->id]);
        } else {
            // Buat baru dengan order_id
            ShippingAddress::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'recipient_name' => $this->shippingName,
                'phone_number' => $this->shippingNumber,
                'address' => $this->shippingAddress,
            ]);
        }

        // Hapus item cart
        Cart::whereIn('id', $selectedCartIds)->delete();

        session()->flash('success', 'Pesanan berhasil dibuat!');
        return redirect('/checkout/success');
    }

    public function handleVoucherApplied($discount, $code)
    {
        $this->discount = $discount;
        $this->voucherCode = $code;
        $this->totalAfterDiscount = $this->total - $this->discount;
        $this->voucherApplied = true;

        session([
            'voucher_code' => $code,
            'voucher_discount' => $discount
        ]);
    }

    public function resetVoucher()
    {
        session()->forget(['voucher_code', 'voucher_discount']);
        $this->voucherCode = null;
        $this->discount = 0;
        $this->totalAfterDiscount = $this->total;
        $this->voucherApplied = false;
    }

    public function render()
    {
        return view('livewire.checkout.checkout-component');
    }

    public function openPaymentModal() //pembayaran
    {
        $this->showEditPayment = true;
    }

    public function closePaymentModal()
    {
        $this->showEditPayment = false;
    }

    public function openEditAddressModal() //address
    {
        $this->showEditAddress = true;
    }

    public function closeEditAddressModal()
    {
        $this->showEditAddress = false;
    }

    public function openVoucher() //voucher
    {
        $this->showVoucher = true;
    }

    public function closeVoucher()
    {
        $this->showVoucher = false;
    }

    public function updatePaymentMethod($method)
    {
        $this->paymentMethod = $method;
        $this->showEditPayment = false;
    }
}
