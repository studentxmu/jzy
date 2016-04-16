<?php 

use App\Finance;
use App\Catagory;
use App\Car;
use App\Buyer;
use App\Employee;
use App\Transaction;
use Redirect, Input, Auth, Session;


function getid()
{
    $car = new Car(100);
    echo $car->id;
}

getid();
