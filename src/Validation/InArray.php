<?php

namespace Neo\Validation;

use RuntimeException;

/**
 * InArray Validation
 *
 * @package Neo\Validation
 */
class InArray extends AbstractValidation
{
    /**
     * @var array
     */
    protected $haystack;

    /**
     * @var string
     */
    protected $delimiter = ',';

    /**
     * @var bool
     */
    protected $caseInsensitive = false;

    /**
     * @var string
     */
    protected $message = 'Invalid array';

    /**
     * InArray constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (!isset($parameters['haystack'])) {
            throw new RuntimeException('You must provide a haystack array.');
        }

        if (isset($parameters['delimiter'])) {
            $this->setDelimiter($parameters['delimiter']);
        }

        $this->setHaystack($parameters['haystack']);

        if (isset($parameters['case_insensitive'])) {
            $this->setCaseInsensitive($parameters['case_insensitive']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (empty($data)) {
            return true;
        }

        if ($this->caseInsensitive) {
            if (in_array(strtolower($data), array_map('strtolower', $this->haystack))) {
                return true;
            }
        } else {
            if (in_array($data, $this->haystack)) {
                return true;
            }
        }

        throw new Exception($this->message);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'in_array';
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return join(',', $this->haystack);
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return array_merge(
            $this->parameters,
            [
                'haystack' => $this->haystack,
                'case_insensitive' => $this->caseInsensitive,
            ]
        );
    }

    /**
     * Set haystack
     *
     * @param array $haystack Haystack
     *
     * @return self
     */
    public function setHaystack($haystack)
    {
        if (!is_array($haystack)) {
            $haystack = explode($this->delimiter, $haystack);
        }

        $this->haystack = $haystack;

        return $this;
    }

    /**
     * Set delimiter
     *
     * @param string $delimiter Delimiter
     *
     * @return self
     */
    public function setDelimiter($delimiter)
    {
        $this->delimiter = strval($delimiter);

        return $this;
    }

    /**
     * Set case insensitive
     *
     * @param boolean $caseInsensitive Case insensitive
     *
     * @return InArray
     */
    public function setCaseInsensitive($caseInsensitive)
    {
        $this->caseInsensitive = boolval($caseInsensitive);

        return $this;
    }
}
