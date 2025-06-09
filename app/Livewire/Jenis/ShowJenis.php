<?php

namespace App\Livewire\Jenis;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ShowJenis extends Component
{
    public $product;
    public $quantity = 1;

    public function mount($id)
    {
        $this->product = Product::findOrFail($id);
    }

    public function incrementQuantity()
    {
        if ($this->quantity < $this->product->stock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        $product = Product::findOrFail($this->product->id);

        if ($product->stock < 1) {
            session()->flash('error', 'Stok produk habis.');
            return;
        }

        if ($this->quantity > $product->stock) {
            session()->flash('error', 'Jumlah melebihi stok yang tersedia.');
            return;
        }

        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $this->quantity;
            $cartItem->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
                'quantity' => $this->quantity,
            ]);
        }

        // Update session cart_count
        session(['cart_count' => Cart::where('user_id', Auth::id())->sum('quantity')]);

        // Kirim event untuk pop-up
        $this->dispatch('product-added-to-cart');
    }

    public function render()
    {
        return view('livewire.jenis.show-jenis');
    }
}