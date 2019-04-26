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

    public function getCoefficients(): iterable;
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

Interpolates **iterables of X values** using the same default **coefficients.** The interpolation method returns a **SplFixedArray**. The Constructor accepts a numbers *iterable* as well as **CoefficientsProviderInterface**:

```php
<?php
use FilmTools\PolynomialModel\MultipleInterpolator;

$coefficients = array(2,3);
$mi = new MultipleInterpolator( $coefficients );

$x_iterable = array(1,2,3);
$interpolated = $mi->interpolate( $x_iterable );
$interpolated = $mi( $x_values );
// SplFixedArray [ 5, 8, 11 ]
```



### DerivativeCoefficientsProvider

Calculates the coefficients for a derivative polynomial on a given a set of coefficients (either array or Provider).

```php
<?php
use FilmTools\PolynomialModel\DerivativeCoefficientsProvider;
use FilmTools\PolynomialModel\CoefficientsProviderInterface;

class MyModel implements CoefficientsProviderInterface
{
  public function getCoefficients(): array
  {
    // Keys are exponents, values are factors!
    return array(0=>16, 1=>30, 2=>5, 3=> 18 );
  }
}
$my_provider = new MyModel;

$derivation_provider = new DerivativeCoefficientsProvider( $my_provider );
$coefficients = $derivation_provider->getCoefficients();
// array( 0 => 30, 1 => 10, 2 => 54)
```

The class itself implements **CoefficientsProviderInterface**, and thus works excellent in conjunction with **MultipleInterpolator:**

```php
use FilmTools\PolynomialModel\DerivativeCoefficientsProvider;
use FilmTools\PolynomialModel\MultipleInterpolator;

$my_provider = new MyModel;
// coefficients = array(0=>16, 1=>30, 2=>5, 3=> 18 );

$derivated_coefficients = new DerivativeCoefficientsProvider( $my_provider );
$mi = new MultipleInterpolator( $derivated_coefficients );

$x_values = array(1,2,3);
$slopes = $mi->interpolate( $x_values );
// 94, 266, 546
```









### Exceptions

The **PolynomialModelException** extends *\Exception* and implements **PolynomialModelExceptionInterface**. 

Both **XNotFoundException** and **YNotFoundException** extend from *PolynomialModelException.* All these have *PolynomialModelExceptionInterface* in common.

## 



