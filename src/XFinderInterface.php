<?php
namespace FilmTools\PolynomialModel;

interface XFinderInterface
{

    /**
     * Finds an X for a given Y coordinate.
     *
     * @param  float $y Y value
     * @return float $x Found X coordinate
     *
     * @throws XNotFoundException
     */
    public function findX( float $y ) : float;
}
