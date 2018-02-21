<?php

namespace Neo\Validation;

/**
 * Boolean Validator
 *
 * @package Neo\Validation
 */
class Boolean extends FilterVar
{
    protected $message = 'Value is invalid.';

    /**
     * Boolean constructor.
     *
     * @param array $parameters Validation parameters
     */
    final public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        $this->setFlags(FILTER_NULL_ON_FAILURE)
            ->setName('boolean')
            ->setType(FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (empty($data)) {
            return true;
        }

        if (
            filter_var(
                $data,
                $this->type,
                ['options' => $this->parameters, 'flags' => $this->flags]
            ) === null
        ) {
            throw new Exception($this->message);
        }

        return true;
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
}
