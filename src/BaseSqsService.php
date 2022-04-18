<?php

namespace Bariseser;

use Aws\Result;
use Aws\Sqs\SqsClient;
use InvalidArgumentException;

abstract class BaseSqsService
{
    /**
     * @var SqsClient
     */
    public SqsClient $awsSqsClient;

    /**
     * @var string
     */
    public string $queueUrl;

    /**
     * @var array|string[]
     */
    protected array $clientOptions = [
        'profile' => 'localstack',
        'region' => 'eu-west-1',
        'version' => '2012-11-05',
    ];

    public string $receiptHandle;

    public function __construct()
    {
        $this->awsSqsClient = new SqsClient($this->clientOptions);
        return $this;
    }

    /**
     * @param array $options
     * @return Result
     */
    public function sendMessage(array $options): Result
    {
        return $this->awsSqsClient->sendMessage($options);
    }

    /**
     * @param array $options
     * @return Result
     */
    public function getMessage(array $options): Result
    {
        return $this->awsSqsClient->receiveMessage($options);
    }

    /**
     * @param array $options
     * @return Result
     */
    public function deleteMessage(array $options): Result
    {
        return $this->awsSqsClient->deleteMessage($options);
    }

    /**
     * @return string
     */
    public function getQueueUrl(): string
    {
        return $this->queueUrl;
    }

    /**
     * @param string $queueUrl
     * @return BaseSqsService
     */
    public function setQueueUrl(string $queueUrl): static
    {
        $this->queueUrl = $queueUrl;
        return $this;
    }

    /**
     * @param string $receiptHandle
     * @return SqsProducer
     */
    public function setReceiptHandle(string $receiptHandle): static
    {
        $this->receiptHandle = $receiptHandle;
        return $this;
    }

    /**
     * @return string
     */
    public function getReceiptHandle(): string
    {
        return $this->receiptHandle;
    }
}