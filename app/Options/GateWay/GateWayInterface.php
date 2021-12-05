<?php
namespace App\Options\GateWay;

interface GateWayInterface{
    public function __construct($data);
    public function send();
    public function verify();
}