<?php

namespace App\Checkout\Implementation;

use App\Checkout\Domain\CheckoutService;
use App\Checkout\Domain\CheckoutRepository;
use App\Checkout\Domain\Checkout;
use App\Ticket\Domain\TicketRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Ticket\Domain\Ticket;
use App\Exceptions\TicketTypeNotFoundException;

class CheckoutServiceImpl implements CheckoutService
{
    public function __construct(
        protected CheckoutRepository $checkoutRepository,
        protected TicketRepository $ticketRepository
    ){}

    public function payout(array $data): Checkout
    {
        $tickets = $this->getTicketsBy($data['type']);
        $isAvailable = fn(Ticket $ticket) => $ticket->getAvailableQuantity() >= $data['quantity'];
        $tickets->filter($isAvailable);
        $data['ticket_id'] = $tickets['id'];
        $model = $this->checkoutRepository->payout($data);
        return new Checkout(
            $model->id,
            $model->ticket_id,
            $model->attendee_id,
            $model->quantity,
            $model->total_price, $model->status);
    }

    public function getOneBy(int $id): Checkout
    {
        return $this->checkoutRepository->getOneBy($id);
    }

    public function update(array $data, int $id): Checkout
    {
        return $this->checkoutRepository->update($data, $id);
    }

    public function delete(int $id): void
    {
        $this->checkoutRepository->delete($id);
    }

    private function getTicketsBy(string $type): Collection
    {
        $tickets = $this->ticketRepository->getAll();
        $byType = $tickets->firstWhere('type', $type);
        if (!$byType) throw new TicketTypeNotFoundException();
        return $tickets;
    }
}