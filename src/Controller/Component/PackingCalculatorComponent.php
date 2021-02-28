<?php

namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\ORM\Query;

class PackingCalculatorComponent extends Component
{
    /**
     * Get the total number of packs required to fulfil the order
     *
     * @param \Cake\ORM\Query $sizesAbove All sizes above the specified quantity
     * @param \Cake\ORM\Query $sizesBelow All sizes below the specified quantity
     * @param int $qty Order quantity
     * @return array Packs to send
     */
    public function getTotalPacks(Query $sizesAbove, Query $sizesBelow, int $qty): array
    {
        $sizeAbove = $sizesAbove->first();

        if (!$sizeAbove) {
            return $this->getSizesBelow($sizesBelow, $qty);
        } elseif ($sizeAbove->pack_size == $qty || !$sizesBelow->count()) {
            return [$sizeAbove->pack_size => 1];
        } else {
            $results = $this->getSizesBelow($sizesBelow, $qty);
            $totalShirts = $this->getTotalShirts($results);

            if ($totalShirts < $sizeAbove->pack_size) {
                return $results;
            } else {
                return [$sizeAbove->pack_size => 1];
            }
        }
    }

    /**
     * Get the number of packs needed of each size, below the ordered quantity, to fulfil the order
     *
     * @param \Cake\ORM\Query $sizesBelow All sizes below the specified quantity
     * @param int $qty Order quantity
     * @return array Packs to send
     */
     public function getSizesBelow(Query $sizesBelow, int $qty): array
     {
         $results = array_fill_keys($sizesBelow->extract('pack_size')->toList(), 0);
         $orderQty = $qty;

         foreach ($sizesBelow as $size) {
             $packs = $this->getPacks($size->pack_size, $qty);

             if ($packs > 0) {
                 $results[$size->pack_size] = $packs;
                 $qty -= $packs * $size->pack_size;
             }
         }

         if ($qty > 0) {
             $results = $this->addMinSize($results, $size->pack_size);
             $remainder = $size->pack_size - $qty;

             for ($i = 1; $i <= count($results); $i++) {
                 $resultsSection = array_slice($results, 0, $i, true);
                 $resultsSection[min(array_keys($resultsSection))]++;
                 $totalShirts = $this->getTotalShirts($resultsSection);

                 if (($totalShirts - $orderQty) == $remainder) {
                     return $resultsSection;
                 }
             }
         }

         return array_filter($results);
     }

    /**
     * Get the total number of shirts to be sent for sizes below the orderd quantity
     *
     * @param array $results Number of packs for each size
     * @return int Total number of shirts
     */
    public function getTotalShirts(array $results): int
    {
        $shirts = 0;

        foreach ($results as $packSize => $packs) {
            $shirts += ($packSize * $packs);
        }

        return $shirts;
    }

    /**
     * Add minimum pack size to the results
     *
     * @param array $results Number of packs for each size
     * @param int $packSize Minimum pack size
     * @return array Packs to send
     */
    public function addMinSize(array $results, int $packSize): array
    {
        isset($results[$packSize]) ? $results[$packSize]++ : $results[$packSize] = 1;

        return $results;
    }

    /**
     * Get the number of packs needed for this size
     *
     * @param int $size Pack size
     * @param int $qty Ordered quantity
     * @return int Packs to send
     */
    public function getPacks(int $size, int $qty): int
    {
        return (int) floor($qty / $size);
    }
}
