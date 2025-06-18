<?php

namespace App\Checkout\Domain;

interface CheckoutService
{
    public function payout(array $data): Checkout;
    public function getOneBy(int $id): Checkout;
    public function update(array $data, int $id): Checkout;
    public function delete(int $id): void;
}