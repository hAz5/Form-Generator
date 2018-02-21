<?php
namespace Neo\Validation;

use InvalidArgumentException;
use RuntimeException;

/**
 * Callback Validation
 *
 * @package Neo\Validation
 */
class Callback extends AbstractValidation
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * Callback constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['callback'])) {
            $this->setCallback($parameters['callback']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (!is_callable($this->callback)) {
            throw new RuntimeException('Callback function is required.');
        }

        $tempData[] = $data;
        $tempData[] = $this->getExtraData();
        if (!call_user_func_array($this->callback, $tempData)) {
            throw new Exception($this->message);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'callback';
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return [
            'message' => $this->message
        ];
    }

    /**
     * set callback after constructor
     *
     * @param callable $callback Callback
     */
    public function setCallback($callback)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('Callback function should be callable.');
        }

        $this->callback = $callback;
    }
}
