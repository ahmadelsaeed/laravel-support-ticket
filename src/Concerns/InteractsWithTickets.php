<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Status;
use Coderflex\LaravelTicket\Models\TicketCategory;
use Illuminate\Database\Eloquent\Model;

trait InteractsWithTickets
{
    /**
     * unprocessed the ticket
     *
     * @return self
     */
    public function updateTicketHistory($user,$status)
    {
        TicketCategory::create([
            'status' => $status,'fileable_type'=>get_class($user),'fileable_id'=>$user->id
        ]);

        return $this;
    }
    /**
     * unprocessed the ticket
     *
     * @return self
     */
    public function unprocessed(): self
    {
        $this->update([
            'status' => Status::UNPROCESSED->value,
        ]);

        return $this;
    }


        
    /**
     * waitDepartmentResponse the ticket
     *
     * @return self
     */
    public function waitDepartmentResponse(): self
    {
        $this->update([
            'status' => Status::WAITDEPARTMENTRESPONSE->value,
        ]);

        return $this;
    }

    /**
     * solved the ticket
     *
     * @return self
     */
    public function solved(): self
    {
        $this->update([
            'status' => Status::SOLVED->value,
        ]);

        return $this;
    }


    /**
     * Close the ticket
     *
     * @return self
     */
    public function close(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
        ]);

        return $this;
    }

    /**
     * Reopen the ticket
     *
     * @return self
     */
    public function reopen(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
        ]);

        return $this;
    }

    /**
     * Determine if the ticket is archived
     *
     * @return bool
     */
    public function isUnProcessed(): bool
    {
        return $this->status == Status::UNPROCESSED->value;
    }

    /**
     * Determine if the ticket is archived
     *
     * @return bool
     */
    public function isWaitDepartmentResponse(): bool
    {
        return $this->status == Status::WAITDEPARTMENTRESPONSE->value;
    }

    /**
     * Determine if the ticket is open
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->status == Status::OPEN->value;
    }

    /**
     * Determine if the ticket is closed
     *
     * @return bool
     */
    public function isClosed(): bool
    {
        return ! $this->isOpen();
    }

    /**
     * Determine if the ticket is resolved
     *
     * @return bool
     */
    public function isResolved(): bool
    {
        return $this->is_resolved;
    }

    /**
     * Determine if the ticket is unresolved
     *
     * @return bool
     */
    public function isUnresolved(): bool
    {
        return ! $this->isResolved();
    }

    /**
     * Determine if the ticket is locked
     *
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Determine if the ticket is unresolved
     *
     * @return bool
     */
    public function isUnlocked(): bool
    {
        return ! $this->isLocked();
    }

    /**
     * Mark the ticket as resolved
     *
     * @return self
     */
    public function markAsResolved(): self
    {
        $this->update([
            'is_resolved' => true,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as locked
     *
     * @return self
     */
    public function markAsLocked(): self
    {
        $this->update([
            'is_locked' => true,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as locked
     *
     * @return self
     */
    public function markAsUnlocked(): self
    {
        $this->update([
            'is_locked' => false,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as archived
     *
     * @return self
     */
    public function markAsArchived(): self
    {
        $this->archive();

        return $this;
    }

    /**
     * Close the ticket and mark it as resolved
     *
     * @return self
     */
    public function closeAsResolved(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => true,
        ]);

        return $this;
    }

    /**
     * Close the ticket and mark it as unresolved
     *
     * @return self
     */
    public function closeAsUnresolved(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => false,
        ]);

        return $this;
    }

    /**
     * Reopen the ticket and mark it as resolved
     *
     * @return self
     */
    public function reopenAsUnresolved(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
            'is_resolved' => false,
        ]);

        return $this;
    }

    /**
     * Add new message on an existing ticket as a custom user
     *
     * @param  \Illuminate\Database\Eloquent\Model|int  $user
     * @return self
     */
    public function assignTo(Model|int $user): self
    {
        $this->update([
            'assigned_to' => $user,
        ]);

        return $this;
    }
}