<?php

namespace Modules\Notifications\Dtos;

use Modules\Notifications\Enums\NotificationTypeEnum;

class NotificationRequestDto extends BaseDto
{
    protected string $templateTopic;
    protected NotificationTypeEnum $typeEnum;
    protected ?int $mobile;
    protected ?string $email;
    protected array $arguments;
    protected string $apiKey;

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }


    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     */
    public function setArguments(array $arguments): void
    {
        $this->arguments = $arguments;
    }

    /**
     * @return string
     */
    public function getTemplateTopic(): string
    {
        return $this->templateTopic;
    }

    /**
     * @param string $templateTopic
     */
    public function setTemplateTopic(string $templateTopic): void
    {
        $this->templateTopic = $templateTopic;
    }

    /**
     * @return NotificationTypeEnum
     */
    public function getTypeEnum(): NotificationTypeEnum
    {
        return $this->typeEnum;
    }

    /**
     * @param NotificationTypeEnum $typeEnum
     */
    public function setTypeEnum(NotificationTypeEnum $typeEnum): void
    {
        $this->typeEnum = $typeEnum;
    }

    /**
     * @return int|null
     */
    public function getMobile(): ?int
    {
        return $this->mobile;
    }

    /**
     * @param int|null $mobile
     */
    public function setMobile(?int $mobile): void
    {
        $this->mobile = $mobile;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

}
