<?php

namespace App\Helpers;

class PriceCalculator
{
    public static function calculatePrice(
        $searchResults,
        $selectedRoute,
        $selectedRetourRoute,
        $selectedStop1,
        $selectedStop2,
        $selectedStops1,
        $selectedStops2,
        $selectedInapoiStop1,
        $selectedInapoiStop2,
        $selectedInapoiStops1,
        $selectedInapoiStops2,
        $numberOfPassangers
    ) {
        $price = 0;

        if (isset($searchResults) && $searchResults['trip_type'] === 'dus-intors') {
            if (($selectedInapoiStop1 && !is_null($selectedInapoiStop1)) || ($selectedInapoiStop2 && !is_null($selectedInapoiStop2))) {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = isset($selectedInapoiStop1)
                        ? (((($selectedStop2->price) + ($selectedRoute->price - $selectedInapoiStop1->price)) * 2) * $numberOfPassangers)
                        : (isset($selectedInapoiStop2)
                            ? ((($selectedInapoiStop2->price) + ($selectedRoute->price - $selectedStop1->price)) * 2) * $numberOfPassangers
                            : 0);
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = isset($selectedInapoiStop1)
                        ? (((($selectedStop2->price_ron) + ($selectedRoute->price_ron - $selectedInapoiStop1->price_ron)) * 2) * $numberOfPassangers)
                        : (isset($selectedInapoiStop2)
                            ? ((($selectedInapoiStop2->price_ron) + ($selectedRoute->price_ron - $selectedStop1->price_ron)) * 2) * $numberOfPassangers
                            : 0);
                } else {
                    $price = isset($selectedInapoiStop1)
                        ? (((($selectedStop2->price) + ($selectedRoute->price - $selectedInapoiStop1->price)) * 2) * $numberOfPassangers)
                        : (isset($selectedInapoiStop2)
                            ? ((($selectedInapoiStop2->price) + ($selectedRoute->price - $selectedStop1->price)) * 2) * $numberOfPassangers
                            : 0);
                }
            } elseif (($selectedInapoiStops2 && !is_null($selectedInapoiStops2))) {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = ((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) * $numberOfPassangers;
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = ((($selectedStops2->price_ron - $selectedStops1->price_ron) + ($selectedInapoiStops2->price_ron - $selectedInapoiStops1->price_ron)) * 2) * $numberOfPassangers;
                } else {
                    $price = ((($selectedStops2->price - $selectedStops1->price) + ($selectedInapoiStops2->price - $selectedInapoiStops1->price)) * 2) * $numberOfPassangers;
                }
            } else {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = ($selectedRetourRoute->price * 2) * $numberOfPassangers;
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = ($selectedRetourRoute->price_ron * 2) * $numberOfPassangers;
                } else {
                    $price = ($selectedRetourRoute->price * 2) * $numberOfPassangers;
                }
            }
        } else {
            if (($selectedStop1 && !is_null($selectedStop1)) || ($selectedStop2 && !is_null($selectedStop2))) {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = isset($selectedStop1)
                        ? ($selectedRoute->price - $selectedStop1->price) * $numberOfPassangers
                        : (isset($selectedStop2)
                            ? $selectedStop2->price * $numberOfPassangers
                            : 0);
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = isset($selectedStop1)
                        ? ($selectedRoute->price_ron - $selectedStop1->price_ron) * $numberOfPassangers
                        : (isset($selectedStop2)
                            ? $selectedStop2->price_ron * $numberOfPassangers
                            : 0);
                } else {
                    $price = isset($selectedStop1)
                        ? ($selectedRoute->price - $selectedStop1->price) * $numberOfPassangers
                        : (isset($selectedStop2)
                            ? $selectedStop2->price * $numberOfPassangers
                            : 0);
                }
            } elseif ($selectedStops2 && !is_null($selectedStops2)) {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = ($selectedStops2->price - $selectedStops1->price) * $numberOfPassangers;
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = ($selectedStops2->price_ron - $selectedStops1->price_ron) * $numberOfPassangers;
                } else {
                    $price = ($selectedStops2->price - $selectedStops1->price) * $numberOfPassangers;
                }
            } else {
                if (isset($searchResults['currency']) && $searchResults['currency'] == 'mdl') {
                    $price = $selectedRoute->price * $numberOfPassangers;
                } elseif (isset($searchResults['currency']) && $searchResults['currency'] == 'ron') {
                    $price = $selectedRoute->price_ron * $numberOfPassangers;
                } else {
                    $price = $selectedRoute->price * $numberOfPassangers;
                }
            }
        }

        return $price;
    }
}
