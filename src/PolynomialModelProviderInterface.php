<?php
namespace FilmTools\PolynomialModel;

interface PolynomialModelProviderInterface
{

    /**
     * Returns a polynomial model.
     *
     * @return PolynomialModelInterface
     */
    public function getPolynomialModel(): PolynomialModelInterface;
}
