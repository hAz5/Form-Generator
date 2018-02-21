<?php

namespace Neo\Validation;

use RuntimeException;

/**
 * Equal Validation
 *
 * @package Neo\Validation
 */
class Equal extends AbstractValidation
{
    /**
     * Equal value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Is type check
     *
     * @var bool
     */
    protected $typeCheck = false;

    /**
     * Equal validation message
     *
     * @var string
     */
    protected $message = 'Invalid value';

    /**
     * Equal constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (!isset($parameters['equal'])) {
            throw new RuntimeException('The equal parameter is required');
        }

        $this->value = $parameters['equal'];

        if (isset($parameters['type_check'])) {
            $this->setTypeCheck($parameters['type_check']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if ($this->typeCheck) {
            $result = $data === $this->value;
        } else {
            $result = $data == $this->value;
        }

        if (!$result) {
            throw new Exception($this->message);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'equal';
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
        return $this->parameters;
    }

    /**
     * Set equal value
     *
     * @param mixed $value Equal value
     *
     * @return self
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Set type check
     *
     * @param boolean $typeCheck Type check
     *
     * @return self
     */
    public function setTypeCheck($typeCheck)
    {
        $this->typeCheck = boolval($typeCheck);

        return $this;
    }
}
