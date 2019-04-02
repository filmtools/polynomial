<?php
namespace FilmTools\PolynomialModel;

interface XFinderInterface
{
    public function findX( float $y ) : float;
}
