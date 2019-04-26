<?php
namespace FilmTools\PolynomialModel;

interface InterpolatorInterface
{

    /**
     * Find an Y value for a given X coordinate.
     *
     * @param  float $x  X coordinate to get an y value for
     * @return float     Calculated Y value
     *
     * @throws YNotFoundException
     */
    public function interpolate( float $x ): float;
}
