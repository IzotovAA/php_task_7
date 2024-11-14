<?php

class MinStack1
{
    private array $stack = [];
    private ?int $min = null;

    /**
     * @param Integer $val
     * @return NULL
     */
    public function push(int $val): null {
        $this->stack[] = $val;

        if ($this->min !== null && $val < $this->min) {
            $this->min = $val;
        } elseif ($this->min === null) {
            $this->min = min($this->stack);
        }

        return null;
    }

    /**
     * @return NULL
     */
    public function pop(): null {
        $delete = array_pop($this->stack);

        if ($delete === $this->min) {
            $this->min = null;
        }

        return null;
    }

    /**
     * @return Integer
     */
    public function top(): int {
        return $this->stack[count($this->stack) - 1];
    }

    /**
     * @return Integer
     */
    public function getMin(): int {
        if ($this->min === null) {
            $this->min = min($this->stack);
        }
        return $this->min;
    }

    public function printStack(): void {
        print_r($this->stack);
    }
}

class MinStack2
{
    private ?StackItem $top = null;

    /**
     * @param Integer $val
     * @return NULL
     */
    public function push(int $val): null
    {
        $stackItem = new StackItem($val);

        if ($this->top !== null) {
            $stackItem->setPrevious($this->top);

            if ($val < $this->top->getMin()) {
                $stackItem->setMin($val);
            } else {
                $stackItem->setMin($this->top->getMin());
            }
        } else {
            $stackItem->setMin($val);
        }

        $this->top = $stackItem;

        return null;
    }

    /**
     * @return NULL
     */
    public function pop(): null
    {
        $this->top = $this->top->getPrevious();

        return null;
    }

    /**
     * @return Integer
     */
    public function top(): int {
        return $this->top->getData();
    }

    /**
     * @return Integer
     */
    public function getMin(): int {
        return $this->top->getMin();
    }
}

class StackItem
{
    private int $data;
    private ?int $min = null;
    private ?StackItem $previous = null;

    public function __construct(int $data)
    {
        $this->data = $data;
    }

    public function getData(): int
    {
        return $this->data;
    }

    public function setPrevious(StackItem $previous): void
    {
        $this->previous = $previous;
    }

    public function getPrevious(): ?StackItem
    {
        return $this->previous;
    }

    public function getMin(): ?int
    {
        return $this->min;
    }

    public function setMin(?int $min): void
    {
        $this->min = $min;
    }
}

class MinStack3
{
    private array $stack = [];

    /**
     * @param Integer $val
     * @return NULL
     */
    public function push(int $val): null {
        $last = array_pop($this->stack);

        if ($last !== null) {
            $this->stack[] = $last;

            if ($val < $last[1]) {
                $this->stack[] = [$val, $val];
            } else {
                $this->stack[] = [$val, $last[1]];
            }
        } else {
            $this->stack[] = [$val, $val];
        }

        return null;
    }

    /**
     * @return NULL
     */
    public function pop(): null {
        array_pop($this->stack);

        return null;
    }

    /**
     * @return Integer
     */
    public function top(): int {
        return $this->stack[count($this->stack) - 1][0];
    }

    /**
     * @return Integer
     */
    public function getMin(): int {
        return $this->stack[count($this->stack) - 1][1];
    }
}