<?php

namespace App\Checkout\Domain;

use App\Checkout\Infra\CheckoutModel;

interface CheckoutRepository
{
    public function payout(array $data): CheckoutModel;
    public function getOneBy(int $id): Checkout;
    public function update(array $data, int $id): Checkout;
    public function delete(int $id): void;
}