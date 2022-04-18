<?php

namespace Bariseser;

use Aws\Result;

class SqsProducer extends BaseSqsService
{

    private int $delaySeconds = 1;

    private string $messageBody;

    private array $messageAttributes = [];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Result
     */
    public function publish(): Result
    {
        return $this->sendMessage($this->getParams());
    }

    /**
     * @return array
     */
    private function getParams(): array
    {
        return [
            'QueueUrl' => $this->getQueueUrl(),
            'DelaySeconds' => $this->delaySeconds,
            'MessageBody' => $this->messageBody,
            'MessageAttributes' => array(),
        ];
    }

    /**
     * @param int $delaySeconds
     * @return SqsProducer
     */
    public function setDelaySeconds(int $delaySeconds): static
    {
        $this->delaySeconds = $delaySeconds;
        return $this;
    }

    /**
     * @param string $messageBody
     * @return SqsProducer
     */
    public function setMessageBody(string $messageBody): static
    {
        $this->messageBody = $messageBody;
        return $this;
    }

    /**
     * @param array $messageAttributes
     * @return SqsProducer
     */
    public function setMessageAttributes(array $messageAttributes): static
    {
        $this->messageAttributes = $messageAttributes;
        return $this;
    }
}