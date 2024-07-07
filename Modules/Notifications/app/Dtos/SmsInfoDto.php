<?php

namespace Modules\Notifications\Dtos;

class SmsInfoDto extends BaseDto
{
    protected int $notificationId;
    protected int $status;
    protected int $sender;
    protected int $messageId;

    protected ?int $providerId;
    protected ?int $id;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getProviderId(): ?int
    {
        return $this->providerId;
    }

    /**
     * @param int|null $providerId
     */
    public function setProviderId(?int $providerId): void
    {
        $this->providerId = $providerId;
    }

    /**
     * @return int
     */
    public function getNotificationId(): int
    {
        return $this->notificationId;
    }

    /**
     * @param int $notificationId
     */
    public function setNotificationId(int $notificationId): void
    {
        $this->notificationId = $notificationId;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getSender(): int
    {
        return $this->sender;
    }

    /**
     * @param int $sender
     */
    public function setSender(int $sender): void
    {
        $this->sender = $sender;
    }

    /**
     * @return int
     */
    public function getMessageId(): int
    {
        return $this->messageId;
    }

    /**
     * @param int $messageId
     */
    public function setMessageId(int $messageId): void
    {
        $this->messageId = $messageId;
    }
}
