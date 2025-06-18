<?php

namespace App\Checkout\Domain;

class Checkout
{
    protected int $id;
    protected int $ticket_id;
    protected int $attendee_id;
    protected int $quantity;
    protected int $total_price;
    protected string $status;

    public function __construct(int $id, int $ticket_id, int $attendee_id, int $quantity, int $total_price, string $status)
    {
        $this->id = $id;
        $this->ticket_id = $ticket_id;
        $this->attendee_id = $attendee_id;
        $this->quantity = $quantity;
        $this->total_price = $total_price;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'ticket_id' => $this->ticket_id,
            'attendee_id' => $this->attendee_id,
            'quantity' => $this->quantity,
            'total_price' => $this->total_price,
            'status' => $this->status,
        ];
    }
}