<?php
namespace App\MyClasses;

use App\Entity\AccomodationType;
use App\Entity\RentPeriodation;
use App\Entity\States;

class AdsFilter
{
    /**
     * @var string
     */
    public $BareSearch_filter = '' ;

    /**
     * @var AccomodationType[]
     */
    public $Accomodation_filter = [0=>'AccomodationType'] ;

    /**
     * @var RentPeriodation[]
     */
    public $RentPeriodation_filter = [] ;

    /**
     * @var States[]
     */
    public $States_filter = [] ;



}
