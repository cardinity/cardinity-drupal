# Cardinity Payment Gateway for Drupal 7

Commerce Cardinity is Drupal Commerce module that integrates Cardinity payment gateway into your Drupal Commerce shop.

## Requirements

 * [Cardinity account](https://cardinity.com/sign-up)
 * Drupal version 7.x

## How to install

  1. Copy the 'commerce_cardinity' folder into the modules directory usually: '/sites/all/modules/'.

  2. In your Drupal site, enable the module under Administration -> Modules The module will be in the group Commerce - Payment.

  3. Get a Cardinity credit card processing account on https://cardinity.com

  4. Configure the payment rule at admin/commerce/config/payment-methods with your Cardinity API keys.

## About

Cardinity is a safe and cost-effective online payment solution for e-commerce businesses selling various products or providing services.

Cardinity is available for EU merchants of different types: from low to high risk, from businesses to sole proprietors, from retail products to digital goods.

We operate not only as a Payment Gateway but also as an Acquiring Bank. With over 10 years of experience in providing reliable online payment services, we continue to grow and improve as a perfect solution for your businesses.

## How to apply

Register directly at our website [https://cardinity.com/sign-up](https://cardinity.com/sign-up).

## Features

1. Direct payment. Only purchase transaction type is supported. For more info see: [https://developers.cardinity.com/api/v1/#create-new-payment](https://developers.cardinity.com/api/v1/#create-new-payment).
2. 3-D Secure support.
3. card on file functionality that allows for you securely to charge a client card without having to deal with the huge hassle of storing credit card numbers.

Note that to enable the card on file functionality you need to install the 2.x version of the commerce_cardonfile module.

Note that recurring transaction can be made within 90 days after initial transaction was made.

## Keywords

payment gateway, credit card payment, online payment, credit card processing, online payment gateway.

## Support

If you have any questions on how to use the module, want to report a bug or request a new feature please contact us info@cardinity.com.

## Change Log

* First commit