<?php

namespace Bariseser;

use Aws\Result;

class SqsConsumer extends BaseSqsService
{

    protected int $waitTimeSeconds = 5;

    protected int $maxNumberOfMessages = 1;

    protected array $messageAttributeNames = [];

    public string $receiptHandle;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return Result
     */
    public function messages(): Result
    {
        return $this->getMessage($this->getParams());
    }

    /**
     * @return Result
     */
    public function delete(): Result
    {
        return $this->deleteMessage($this->getDeleteParams());
    }

    /**
     * @return array
     */
    private function getParams(): array
    {
        return [
            'QueueUrl' => $this->getQueueUrl(),
            'WaitTimeSeconds' => $this->waitTimeSeconds,
            'MaxNumberOfMessages' => $this->maxNumberOfMessages,
            'MessageAttributeNames' => ['All']
        ];
    }

    /**
     * @return array
     */
    private function getDeleteParams(): array
    {
        return [
            'QueueUrl' => $this->getQueueUrl(),
            'ReceiptHandle' => $this->getReceiptHandle(),
        ];
    }

    /**
     * @param int $waitTimeSeconds
     * @return SqsConsumer
     */
    public function setWaitTimeSeconds(int $waitTimeSeconds): self
    {
        $this->waitTimeSeconds = $waitTimeSeconds;
        return $this;
    }

    /**
     * @param int $maxNumberOfMessages
     * @return SqsConsumer
     */
    public function setMaxNumberOfMessages(int $maxNumberOfMessages): self
    {
        $this->maxNumberOfMessages = $maxNumberOfMessages;
        return $this;
    }

    /**
     * @param array $messageAttributeNames
     * @return SqsConsumer
     */
    public function setMessageAttributeNames(array $messageAttributeNames): self
    {
        $this->messageAttributeNames = $messageAttributeNames;
        return $this;
    }
}