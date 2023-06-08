<?php

namespace App\Enums;

enum PaymentType:string {
    case VISA = 'Visa';
    case MC = 'Master Card';
    case PAYPAL = 'Paypal';
}