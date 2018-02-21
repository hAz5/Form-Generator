<?php

namespace Neo\Validation;

/**
 * Interface ValidationInterface
 *
 * @package Neo\Validation
 */
interface ValidationInterface
{
    /**
     * Try to validate data using this validator
     * Main function
     *
     * @param mixed $data Data pass for the validation
     *
     * @return boolean
     * @throws \Neo\Validation\Exception
     */
    public function validate($data);

    /**
     * Use this to implement client side validation
     *
     * @return string name of current validator
     */
    public function getName();

    /**
     * Set validation message
     *
     * @param string $message Validation message
     *
     * @return self
     */
    public function setMessage($message);

    /**
     * Get validation message
     *
     * @return string
     */
    public function getMessage();

    /**
     * Get parameters for this validator, use only in client side
     *
     * @return mixed parameters to use in client side
     */
    public function getParameters();

    /**
     * Get Options that validator made of
     *
     * @return array
     */
    public function getValidationOptions();

    /**
     * Set extra data
     *
     * @param mixed $extraData Extra data
     *
     * @return self
     */
    public function setExtraData($extraData);

    /**
     * Get extra data
     *
     * @return mixed
     */
    public function getExtraData();
}
