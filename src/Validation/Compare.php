<?php

namespace Neo\Validation;

use InvalidArgumentException;
use RuntimeException;

/**
 * Compare Validator
 *
 * @package Neo\Validation
 */
class Compare extends AbstractValidation
{
    const OPERATOR_EQUAL = 1;
    const OPERATOR_NOT_EQUAL = 2;
    const OPERATOR_IDENTICAL = 3;
    const OPERATOR_NOT_IDENTICAL = 4;
    const OPERATOR_GREATER_THAN = 5;
    const OPERATOR_GREATER_THAN_EQUAL = 6;
    const OPERATOR_LESS_THAN_EQUAL = 7;
    const OPERATOR_LESS_THAN = 8;

    const TYPE_NUMBER = 1;
    const TYPE_DATE = 2;
    const TYPE_STRING = 3;

    /**
     * @var mixed field or value to compare data to
     */
    private $compareTo;

    /**
     * @var int
     */
    private $type = self::TYPE_NUMBER;

    /**
     * @var int
     */
    private $operator = self::OPERATOR_EQUAL;

    /**
     * Compare constructor.
     *
     * @param array $parameters validator parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        if (isset($parameters['compareTo'])) {
            $this->setCompareTo($parameters['compareTo']);
        }

        if (isset($parameters['operator'])) {
            $this->setOperator($parameters['operator']);
        }

        if (isset($parameters['type'])) {
            $this->setType($parameters['type']);
        }
    }

    /**
     * Factory method for chain ability.
     *
     * @param array $parameters Validation parameters
     *
     * @return self
     */
    public static function create(array $parameters = [])
    {
        return parent::create($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        $data = $this->prepareData($data);
        $this->compareTo = $this->prepareData($this->compareTo);

        if (null === $this->compareTo) {
            throw new RuntimeException('The compareTo parameter is required');
        }

        try {
            switch ($this->operator) {
                case self::OPERATOR_EQUAL:
                    $result = ($data == $this->compareTo);
                    break;
                case self::OPERATOR_IDENTICAL:
                    $result = ($data === $this->compareTo);
                    break;
                case self::OPERATOR_NOT_IDENTICAL:
                    $result = ($data !== $this->compareTo);
                    break;
                case self::OPERATOR_NOT_EQUAL:
                    $result = ($data != $this->compareTo);
                    break;
                case self::OPERATOR_GREATER_THAN:
                    $result = ($data > $this->compareTo);
                    break;
                case self::OPERATOR_GREATER_THAN_EQUAL:
                    $result = ($data >= $this->compareTo);
                    break;
                case self::OPERATOR_LESS_THAN:
                    $result = ($data < $this->compareTo);
                    break;
                case self::OPERATOR_LESS_THAN_EQUAL:
                    $result = ($data <= $this->compareTo);
                    break;
                default:
                    $result = ($data == $this->compareTo);
                    break;
            }
        } catch (Exception $e) {
            throw new Exception('Wrong compare type');
        }

        if ($result) {
            return true;
        }

        throw new Exception($this->message);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'Compare';
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
     * We are already handling three types here (number, string and date) so we need to change data accordingly
     *
     * @param mixed $data Data
     *
     * @return \DateTime|float|\Neo\I18n\DateTime|mixed
     */
    private function prepareData($data)
    {
        if (!in_array($this->operator, [self::OPERATOR_IDENTICAL, self::OPERATOR_NOT_IDENTICAL])) {
            switch ($this->type) {
                case self::TYPE_NUMBER:
                    $data = doubleval($data);
                    break;
                case self::TYPE_DATE:
                    if (!($data instanceof \DateTime)) {
                        if ($data instanceof \Neo\Form\Element\Date) {
                            $data = new \DateTime($data->getvalue());
                        } else {
                            $data = new \DateTime($data);
                        }
                    } else {
                        $data = $data;
                    }
                    break;
                case self::TYPE_STRING:
                default:
                    $data = (string)$data;
                    break;
            }
        }

        return $data;
    }

    /**
     * Set compare to value
     *
     * @param mixed $compareTo Compare to value
     *
     * @return self
     */
    public function setCompareTo($compareTo)
    {
        if (is_array($compareTo)) {
            if (method_exists($compareTo[0], 'getValue')) {
                $this->compareTo = $compareTo[0];
            } else {
                throw new RuntimeException('Object must implement getValue method.');
            }
        } elseif (is_object($compareTo)) {
            if (method_exists($compareTo, 'getValue')) {
                $this->compareTo = $compareTo;
            } else {
                throw new RuntimeException('Object must implement getValue method.');
            }
        } else {
            $this->compareTo = $compareTo;
        }

        return $this;
    }

    /**
     * Set compare operator
     *
     * @param mixed $operator Compare operator
     *
     * @return Compare
     */
    public function setOperator($operator)
    {
        if (!in_array(
            $operator,
            [
                self::OPERATOR_EQUAL,
                self::OPERATOR_IDENTICAL,
                self::OPERATOR_NOT_IDENTICAL,
                self::OPERATOR_NOT_EQUAL,
                self::OPERATOR_GREATER_THAN,
                self::OPERATOR_GREATER_THAN_EQUAL,
                self::OPERATOR_LESS_THAN,
                self::OPERATOR_LESS_THAN_EQUAL
            ]
        )
        ) {
            throw new InvalidArgumentException('Operator does not valid.');
        }

        $this->operator = $operator;

        return $this;
    }

    /**
     * Set compare type
     *
     * @param int $type Compare type
     *
     * @return self
     */
    public function setType($type)
    {
        if (!in_array($type, [self::TYPE_DATE, self::TYPE_NUMBER, self::TYPE_STRING])) {
            throw new InvalidArgumentException('Type does not valid.');
        }

        $this->type = $type;

        return $this;
    }
}
