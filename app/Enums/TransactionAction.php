<?php

namespace App\Enums;

enum TransactionAction : string
{
  case ADD_PRODUCT = 'ADD_PRODUCT';
  case DELETE_PRODUCT = 'DELETE_PRODUCT';
  case SET_SUPPLIER = 'SET_SUPPLIER';
  case SET_QUANTITY = 'SET_QUANTITY';
  case SET_DISCOUNT = 'SET_DISCOUNT';
  case SET_CUSTOMER = 'SET_CUSTOMER';
  case SET_SHIPPING = 'SET_SHIPPING';
  case SET_TAX = 'SET_TAX';
}
