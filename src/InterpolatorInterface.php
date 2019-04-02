<?php
namespace FilmTools\PolynomialModel;

interface InterpolatorInterface
{

    /**
     * Find an y value for a given x coordinate.
     *
     * @param  float $x  X coordinate to get an y value for
     * @return float     Calculated Y value
     */
    public function interpolate( float $x ): float;
}
