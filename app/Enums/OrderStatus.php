<?php

namespace App\Enums;

enum OrderStatus:string {
    case PENDING = 'Pending';
    case CLOSED = 'Closed';
    case CANCELED = 'Canceled';
    case PAID = 'Paid';
}