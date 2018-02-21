<?php

namespace Neo\Validation;

use Neo\I18n\DateTime;

/**
 * Date Validator
 *
 * @package Neo\Validation
 */
class Date extends AbstractValidation
{
    /**
     * Date validation message
     *
     * @var string
     */
    protected $message = 'Date format is not valid';

    /**
     * Date format
     *
     * @var string
     */
    protected $format = 'Y-m-d';

    /**
     * Date constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['format'])) {
            $this->setFormat($parameters['format']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if ($data == '') {
            return true;
        }

        $date = DateTime::createFromFormat($this->format, $data);

        if ($date && $date->format($this->format) == $data) {
            return true;
        }

        throw new Exception($this->message);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'date';
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
            'message' => $this->message,
        ];
    }

    /**
     * Set date format
     *
     * @param string $format Date format
     *
     * @return self
     */
    public function setFormat($format)
    {
        $this->format = $format;

        return $this;
    }
}
