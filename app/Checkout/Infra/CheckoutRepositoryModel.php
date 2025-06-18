<?php

namespace App\Checkout\Infra;

use App\Checkout\Domain\Checkout;
use App\Checkout\Domain\CheckoutRepository;
use App\Ticket\Infra\TicketModel;
use App\Attendee\Infra\AttendeeModel;

class CheckoutRepositoryModel implements CheckoutRepository
{
    public function __construct(
        protected CheckoutModel $checkout,
        protected TicketModel $ticket,
        protected AttendeeModel $attendee
    ) {}

    public function payout(array $data): CheckoutModel
    {
        $checkout = $this->checkout::create($data);
        $ticket = $this->ticket::find($data['ticket_id']);
        $ticket->update([
            'available_quantity' => $ticket->available_quantity - $data['quantity']
        ]);
        $attendee = $this->attendee::find($data['attendee_id']);
        $attendee->update([
            'quantity' => $attendee->quantity + $data['quantity']
        ]);
        return $checkout;
    }

    public function getOneBy(int $id): Checkout
    {
        $checkout = CheckoutModel::find($id);
        return new Checkout(
            $checkout->id,
            $checkout->ticket_id,
            $checkout->attendee_id,
            $checkout->quantity,
            $checkout->total_price, 
            $checkout->status
        );
    }

    public function update(array $data, int $id): Checkout
    {
        $checkout = CheckoutModel::find($id);
        $checkout->update($data);
        return new Checkout(
            $checkout->id,
            $checkout->ticket_id,
            $checkout->attendee_id,
            $checkout->quantity,
            $checkout->total_price,
            $checkout->status
        );
    }

    public function delete(int $id): void
    {
        CheckoutModel::destroy($id);
    }

    private function getCheckout(CheckoutModel $checkout): Checkout
    {
        return new Checkout(
            $checkout->id,
            $checkout->ticket_id,
            $checkout->attendee_id,
            $checkout->quantity,
            $checkout->total_price,
            $checkout->status
        );
    }
}