<?php

namespace Neo\Validation;

/**
 * String Validation
 *
 * @package Neo\Validation
 */
class Str extends AbstractValidation
{
    protected $minLength = false;
    protected $maxLength = false;
    protected $minWord = false;
    protected $maxWord = false;
    protected $message = '';

    /**
     * Str constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['min_length'])) {
            $this->setMinLength($parameters['min_length']);
        }

        if (isset($parameters['max_length'])) {
            $this->setMaxLength($parameters['max_length']);
        }

        if (isset($parameters['min_word'])) {
            $this->setMinWord($parameters['min_word']);
        }

        if (isset($parameters['max_word'])) {
            $this->setMaxWord($parameters['max_word']);
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

        $count = strlen($data);
        $wordCount = str_word_count($data, 0, '0..9');
        $err = [];

        if ($this->minLength !== false && $count < $this->minLength) {
            $err[] = sprintf('%d characters or more expected.', $this->minLength);
        }

        if ($this->maxLength !== false && $count > $this->maxLength) {
            $err[] = sprintf('%d characters or less expected.', $this->minLength);
        }

        if ($this->minWord !== false && $wordCount < $this->minWord) {
            $err[] = sprintf('%d words or more expected.', $this->minWord);
        }

        if ($this->maxWord !== false && $wordCount > $this->maxWord) {
            $err[] = sprintf('%d words or less expected.', $this->maxWord);
        }

        if ($err) {
            $message = ($this->message) ? $this->message : join(',', $err);
            throw new Exception($message);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'string';
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        $result = [];

        if ($this->minLength !== false) {
            $result[] = $this->minLength;
        } else {
            $result[] = '';
        }

        if ($this->maxLength !== false) {
            $result[] = $this->maxLength;
        } else {
            $result[] = '';
        }

        if ($this->minWord !== false) {
            $result[] = $this->minWord;
        } else {
            $result[] = '';
        }

        if ($this->maxWord !== false) {
            $result[] = $this->maxWord;
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
            'min_length' => $this->minLength,
            'max_length' => $this->maxLength,
            'min_word' => $this->minWord,
            'max_word' => $this->maxWord,
            'message' => $this->message,
        ];
    }

    /**
     * Set min length
     *
     * @param int $minLength Min length
     *
     * @return self
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
        $this->parameters['min_length'] = $this->minLength;

        return $this;
    }

    /**
     * Set max length
     *
     * @param int $maxLength Max length
     *
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        $this->parameters['max_length'] = $this->maxLength;

        return $this;
    }

    /**
     * Set min word
     *
     * @param int $minWord Min word
     *
     * @return self
     */
    public function setMinWord($minWord)
    {
        $this->minWord = $minWord;
        $this->parameters['min_word'] = $this->minWord;

        return $this;
    }

    /**
     * Set max word
     *
     * @param int $maxWord Max word
     *
     * @return self
     */
    public function setMaxWord($maxWord)
    {
        $this->maxWord = $maxWord;
        $this->parameters['max_word'] = $this->maxWord;

        return $this;
    }
}
