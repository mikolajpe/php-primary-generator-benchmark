<?php

/**
 * Class GeneratorBench
 *
 * @Iterations(100)
 * @Revs(200)
 */
final class PrimaryBench
{
    const PRIME_COUNT = 200;

    function isPrime($num) {
        //1 is not prime. See: http://en.wikipedia.org/wiki/Prime_number#Primality_of_one
        if($num == 1)
            return false;

        //2 is prime (the only even number that is prime)
        if($num == 2)
            return true;

        /**
         * if the number is divisible by two, then it's not prime and it's no longer
         * needed to check other even numbers
         */
        if($num % 2 == 0) {
            return false;
        }

        /**
         * Checks the odd numbers. If any of them is a factor, then it returns false.
         * The sqrt can be an aproximation, hence just for the sake of
         * security, one rounds it to the next highest integer value.
         */
        for($i = 3; $i <= ceil(sqrt($num)); $i = $i + 2) {
            if($num % $i == 0)
                return false;
        }

        return true;
    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeNormal()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            while (!$self->isPrime(++$v));
            return $v;
        };

        $i = 7;
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $i = $tgen($i);
        }
    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeOldNormalWhile()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            while (true) {
                if ($self->isPrime(++$v)) {
                    return $v;
                }
            };
        };

        $i = 7;
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $i = $tgen($i);
        }
    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeOldNormalFor()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            for(;;) {
                if ($self->isPrime(++$v)) {
                    return $v;
                }
            };
        };

        $i = 7;
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $i = $tgen($i);
        }
    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeOldNormalGoto()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            start:
            if ($self->isPrime(++$v)) {
                return $v;
            }
            goto start;
        };

        $i = 7;
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $i = $tgen($i);
        }
    }


    /**
     * @Iterations(1000)
     */
    public function benchPrimeNormalWhileInline()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            while(!$self->isPrime(++$v));
            return $v;
        };


        $i = 7;
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $i = $tgen($i);
        }

    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeGenerator()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            while(true) {
                while (!$self->isPrime(++$v));
                yield $v;
            }
        };


        $i = 7;
        $gen = $tgen($i);
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $gen->next();
            $b = $gen->current();
        }

    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeGeneratorIf()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            while (true) {
                if($self->isPrime(++$v)) {
                    yield $v;
                }
            };
        };


        $i = 7;
        $gen = $tgen($i);
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $gen->next();
            $b = $gen->current();
        }

    }

    /**
     * @Iterations(1000)
     */
    public function benchPrimeGeneratorGoto()
    {
        $self = $this;
        $tgen = function($v) use ($self) {
            start2:
            if($self->isPrime(++$v)) {
                yield $v;
            }
            goto start2;
        };


        $i = 7;
        $gen = $tgen($i);
        for ($a = 0; $a < self::PRIME_COUNT; $a++) {
            $gen->next();
            $b = $gen->current();
        }

    }
}
