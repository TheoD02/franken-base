<?php

namespace App\Tests\Benchmark;

use App\Tests\CustomCollection;
use App\User\ValueObject\User;
use Doctrine\Common\Collections\ArrayCollection;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;

#[Revs(100)]
#[Iterations(5)]
class ArrayBench
{
    public const int MAX = 80_000;

    public function benchNativeArray(): void
    {
        $data = [];
        foreach (range(1, self::MAX) as $i) {
            $data[] = $i;
        }
    }

    public function benchNativeArrayToDoctrineArrayCollection(): void
    {
        $data = [];
        foreach (range(1, self::MAX) as $i) {
            $data[] = $i;
        }
        $collection = new ArrayCollection($data);
        $collection->add(new User());

        $final = $collection->toArray();
    }

//    public function benchLoophpCollection(): void
//    {
//        $collection = Collection::empty();
//        foreach (range(1, self::MAX) as $i) {
//            $collection = $collection->append($i);
//        }
//    }

//    public function benchDoctrineArrayCollection(): void
//    {
//        $doctrineArray = new ArrayCollection();
//        foreach (range(1, self::MAX) as $i) {
//            $doctrineArray->add(new User());
//        }
//    }
//
//    public function benchVokuArrayWithPush(): void
//    {
//        $vokuArray = new Arrayy();
//        foreach (range(1, self::MAX) as $i) {
//            $vokuArray->push(new User());
//        }
//    }
//
//    public function benchVokuArrayWithAppend(): void
//    {
//        $vokuArray = new Arrayy();
//        foreach (range(1, self::MAX) as $i) {
//            $vokuArray->append(new User());
//        }
//    }
}