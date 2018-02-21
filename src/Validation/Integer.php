<?php

namespace Neo\Validation;

/**
 * Integer Validation
 *
 * @package Neo\Validation
 */
class Integer extends FilterVar
{
    protected $minRange = false;
    protected $maxRange = false;
    protected $message = 'Invalid number';

    /**
     * Integer constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['min_range'])) {
            $this->setMinRange($parameters['min_range']);

            if (false === $parameters['min_range']) {
                unset($this->parameters['min_range']);
            }
        }

        if (isset($parameters['max_range'])) {
            $this->setMaxRange($parameters['max_range']);

            if (false === $parameters['max_range']) {
                unset($this->parameters['max_range']);
            }
        }

        $this->setName('integer')
            ->setType(FILTER_VALIDATE_INT);
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        $result = [];
        if ($this->minRange !== false) {
            $result[] = $this->minRange;
        } else {
            $result[] = '';
        }
        if ($this->maxRange !== false) {
            $result[] = $this->maxRange;
        } else {
            $result[] = '';
        }

        return join(',', $result);
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return [
            'message' => $this->message,
        ];
    }

    /**
     * Set minimum range
     *
     * @param int $minRange Minimum range
     *
     * @return self
     */
    public function setMinRange($minRange)
    {
        $this->minRange = $minRange;
        $this->parameters['min_range'] = $this->minRange;

        return $this;
    }

    /**
     * Set maximum range
     *
     * @param int $maxRange Maximum range
     *
     * @return self
     */
    public function setMaxRange($maxRange)
    {
        $this->maxRange = $maxRange;
        $this->parameters['max_range'] = $this->maxRange;

        return $this;
    }
}
