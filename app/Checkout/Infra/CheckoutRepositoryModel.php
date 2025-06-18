<?php

namespace App\Checkout\Infra;

use App\Checkout\Domain\Checkout;
use App\Checkout\Domain\CheckoutRepository;
use App\Ticket\Domain\TicketRepository;
use App\Attendee\Domain\AttendeeRepository;
use App\Ticket\Infra\TicketModel;
use App\Attendee\Infra\AttendeeModel;
use App\Exceptions\PayoutException;

class CheckoutRepositoryModel implements CheckoutRepository
{
    public function __construct(
        protected CheckoutModel $checkout,
        protected TicketRepository $ticketRepository,
        protected AttendeeRepository $attendeeRepository
    ) {}

    public function payout(array $data): CheckoutModel
    {
        try {
            $checkout = $this->checkout::create($data);
            $this->ticketPayout($data['ticket_id'], $data['quantity']);
            $this->attendeePayout($data);

            return $checkout;   
        } catch (\Throwable $th) {
            throw new PayoutException();
        }
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

    private function ticketPayout(int $ticketId, int $quantity): TicketModel
    {
        $ticket = $this->ticketRepository->getOne($ticketId);
        return $this->ticketRepository->decreaseAvailableQuantity($ticket->id, $quantity);
    }

    private function attendeePayout(array $data): AttendeeModel
    {
        $attendee = [
            'ticket_id' => $data['ticket_id'],
            'name' => $data['attendee_name'],
            'phone_number' => $data['attendee_phone_number'],
            'email' => $data['attendee_email'],

        ];

        return $this->attendeeRepository->create($attendee);
    }
}