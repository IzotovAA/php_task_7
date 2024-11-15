<?php

class Solution1
{
    private array $unprocessed = [];
    private array $temperatures = [];

    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {
        $this->temperatures = $temperatures;

        foreach ($this->temperatures as $index => $temperature) {
            if (isset($this->temperatures[$index + 1]) && $temperature < $this->temperatures[$index + 1]) {
                $this->temperatures[$index] = 1;

                if ($this->unprocessed[count($this->unprocessed)  - 1][1] < $temperature) {
                    $this->temperatures = $this->processing($index, $temperature);
                }
            } else {
                if ($this->unprocessed[count($this->unprocessed)  - 1][1] < $temperature) {
                    $this->temperatures = $this->processing($index, $temperature);
                }

                $this->unprocessed[] = [$index, $temperature];
            }
        }

        if (!empty($this->unprocessed)) {
            foreach ($this->unprocessed as $item) {
                $this->temperatures[$item[0]] = 0;
            }
        }

        return $this->temperatures;
    }

    private function processing($index, $temperature): array
    {
        if (!empty($this->unprocessed)) {
            $item = array_pop($this->unprocessed);

            while ($item[1] < $temperature) {
                $this->temperatures[$item[0]] = $index - $item[0];

                if (!empty($this->unprocessed)) {
                    $item = array_pop($this->unprocessed);
                } else {
                    $item = [0, 101];
                }
            }

            if ($item[1] !== 101) {
                $this->unprocessed[] = $item;
            }
        }

        return $this->temperatures;
    }
}

class Solution2
{
    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {
        $unprocessed = [];

        foreach ($temperatures as $index => $temperature) {
            if (isset($temperatures[$index + 1])
                && $temperature < $temperatures[$index + 1]) {
                $temperatures[$index] = 1;

                if (isset($unprocessed[0])
                    && end($unprocessed)[1] < $temperature) {
                    while (isset($unprocessed[0])
                        && end($unprocessed)[1] < $temperature) {
                        $lastStackIndex = end($unprocessed)[0];
                        $temperatures[$lastStackIndex] = $index - $lastStackIndex;
                        array_pop($unprocessed);
                    }
                }
            } else {
                if (isset($unprocessed[0])
                    && end($unprocessed)[1] < $temperature) {
                    while (isset($unprocessed[0])
                        && end($unprocessed)[1] < $temperature) {
                        $lastStackIndex = end($unprocessed)[0];
                        $temperatures[$lastStackIndex] = $index - $lastStackIndex;
                        array_pop($unprocessed);
                    }
                }

                $unprocessed[] = [$index, $temperature];
            }
        }

        if (isset($unprocessed[0])) {
            foreach ($unprocessed as $item) {
                $temperatures[$item[0]] = 0;
            }
        }

        return $temperatures;
    }
}

class Solution3
{
    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {
        $unprocessed = [];

        foreach ($temperatures as $index => $temperature) {
            $lastStackElement = end($unprocessed);

            if (isset($temperatures[$index + 1])
                && $temperature < $temperatures[$index + 1]) {
                $temperatures[$index] = 1;

                if ($lastStackElement) {
                    while ($lastStackElement
                        && $lastStackElement[1] < $temperature) {
                        $temperatures[$lastStackElement[0]] = $index - $lastStackElement[0];
                        array_pop($unprocessed);
                        $lastStackElement = end($unprocessed);
                    }
                }
            } else {
                if ($lastStackElement) {
                    while ($lastStackElement
                        && $lastStackElement[1] < $temperature) {
                        $temperatures[$lastStackElement[0]] = $index - $lastStackElement[0];
                        array_pop($unprocessed);
                        $lastStackElement = end($unprocessed);
                    }
                }

                $unprocessed[] = [$index, $temperature];
            }
        }

        if (isset($unprocessed[0])) {
            foreach ($unprocessed as $item) {
                $temperatures[$item[0]] = 0;
            }
        }

        return $temperatures;
    }
}

class Solution4
{
    /**
     * @param Integer[] $temperatures
     * @return Integer[]
     */
    public function dailyTemperatures(array $temperatures): array
    {
        $unprocessed = [];
        $lastStackElement = false;

        foreach ($temperatures as $index => $temperature) {
            if ($lastStackElement) {
                while ($lastStackElement
                    && $lastStackElement[1] < $temperature) {
                    $temperatures[$lastStackElement[0]] = $index - $lastStackElement[0];
                    array_pop($unprocessed);
                    $lastStackElement = end($unprocessed);
                }
            }

            $unprocessed[] = [$index, $temperature];
            $lastStackElement = [$index, $temperature];
        }

        if ($lastStackElement) {
            foreach ($unprocessed as $item) {
                $temperatures[$item[0]] = 0;
            }
        }

        return $temperatures;
    }
}