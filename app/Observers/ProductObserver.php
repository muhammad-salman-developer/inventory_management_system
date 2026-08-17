<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\StockLowNotification;

class ProductObserver
{
    protected $threshold = 10;
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('stock') && $product->stock < $this->threshold) {
            // Spatie Permission ka method - role name se users nikalna
            $users = User::role(['admin', 'manager'])->get();

            foreach ($users as $user) {
                $user->notify(new StockLowNotification($product));
            }
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        //
    }
}
