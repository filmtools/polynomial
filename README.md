# FilmTools · Polynomial

**Tools for working with simple polynomial models.**



## Installation 

```php
$ composer require filmtools/polynomial
```



## What's in the package

### Interfaces

**CoefficientsProviderInterface:** 
Returns the coefficients of the polynomial model.

    public function getCoefficients(): array;
**InterpolatorInterface:** 
Find an y value for a given x coordinate.

    public function interpolate( float $x ): float;
**XFinderInterface:** 
Find an x for a given y, as opposite to *InterpolatorInterface*::interpolate

```php+HTML
public function findX( float $y ) : float;
```

**PolynomialModelInterface** 
extends *InterpolatorInterface,* *XFinderInterface*, and *CoefficientsProviderInterface*

**PolynomialModelProviderInterface** 
returns a polynomial model interface instance.

    public function getPolynomialModel(): PolynomialModelInterface;


Interpolates an array of X values using the same coefficients.

```php
<?php
use FilmTools\PolynomialModel\MultipleInterpolator;

$coefficients = array(2,3);
$mi = new MultipleInterpolator( $coefficients );

$x_values = array(1,2,3);
$interpolated = $mi->interpolate( $x_values );
$interpolated = $mi( $x_values );
// Array [ 5, 8, 11 ]
```





### FromCoefficientsInterpolator

This callable class interpolates a **default set of X values** using the **coefficients** given on invokation:

```php
<?php
use FilmTools\PolynomialModel\FromCoefficientsInterpolator;

// Use these X values every time:
$x_values = array(1,2,3);
$fci = new FromCoefficientsInterpolator( $x_values );

// Now find Y for each X
$interpolated = $fci( [
  0 => 2, 
  1 => 3
]); // Array [ 5, 8, 11 ]

```

You may also pass **custom X values** on invokation:

```php
$fci = new FromCoefficientsInterpolator;

$coefficients = array(2,3);
$x_values = array(1,2,3);

// Now find Y for each X
$interpolated = $fci( $coefficients, $x_values); // Array [ 5, 8, 11 ]

```

The interpolation method also accepts **CoefficientsProviderInterface:**

```php
use FilmTools\PolynomialModel\CoefficientsProviderInterface;
use FilmTools\PolynomialModel\FromCoefficientsInterpolator;

class MyModel implements CoefficientsProviderInterface
{
  public function getCoefficients(): array
  {
    return array(2,3);
  }
}

$x_values = array(1,2,3);
$fci = new FromCoefficientsInterpolator( $x_values );
$interpolated = $fci( new MyModel ); // Array [ 5, 8, 11 ]
```



### MultipleInterpolator

Interpolates **arrays of X values** using the same default **coefficients.** The Constructor accepts a number array as well as **CoefficientsProviderInterface**:

```php
<?php
use FilmTools\PolynomialModel\MultipleInterpolator;

$coefficients = array(2,3);
$mi = new MultipleInterpolator( $coefficients );

$x_values = array(1,2,3);
$interpolated = $mi->interpolate( $x_values );
$interpolated = $mi( $x_values );
// Array [ 5, 8, 11 ]
```





### Exceptions

The **PolynomialModelException** extends *\Exception* and implements **PolynomialModelExceptionInterface**. 

Both **XNotFoundException** and **YNotFoundException** extend from *PolynomialModelException.* All these have *PolynomialModelExceptionInterface* in common.

## 



- FromCoefficientsInterpolator