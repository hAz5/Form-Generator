<?php

namespace Neo\Validation;

use RuntimeException;

/**
 * FilterVar Validation
 *
 * @package Neo\Validation
 */
abstract class FilterVar extends AbstractValidation
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $flags = [];

    /**
     * FilterVar constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['type'])) {
            $this->setType($parameters['type']);
            unset($this->parameters['type']);
        }

        if (isset($parameters['name'])) {
            $this->setName($parameters['name']);
            unset($this->parameters['name']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (null === $this->type) {
            throw new RuntimeException('Type is required.');
        }

        if (null === $this->name) {
            throw new RuntimeException('Name is required.');
        }

        if ('' === $data) {
            return true;
        }

        if (
            filter_var(
                $data,
                $this->type,
                ['options' => $this->parameters, 'flags' => $this->flags]
            ) === false
        ) {
            throw new Exception($this->message);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return $this->parameters;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return '';
    }

    /**
     * Set filter name
     *
     * @param string $name Filter name
     *
     * @return self
     */
    protected function setName($name)
    {
        $this->name = strval($name);

        return $this;
    }

    /**
     * Set filter type
     *
     * @param int $type Filter type
     *
     * @return self
     */
    protected function setType($type)
    {
        $this->type = intval($type);

        return $this;
    }

    /**
     * Set validation flags
     *
     * @param array $flags Validation flags
     *
     * @return self
     */
    public function setFlags($flags)
    {
        if (!is_array($flags)) {
            $flags = [$flags];
        }

        $this->flags = $flags;

        return $this;
    }
}
