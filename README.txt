CONTENTS OF THIS FILE
---------------------

 * Introduction
 * Features
 * Installation
 * Support

INTRODUCTION
------------

Commerce Cardinity is Drupal Commerce module that integrates Cardinity payment
gateway into your Drupal Commerce shop.


FEATURES
--------

1. Direct payment. Only purchase transaction type is supported. For more info see:
https://developers.cardinity.com/api/v1/#create-new-payment
2. 3-D Secure support.
3. card on file functionality that allows for you securely to charge a client
card without having to deal with the huge hassle of storing credit card numbers.

Note that to enable the card on file functionality you need to install
the 2.x version of the commerce_cardonfile module.

Note that recurring transaction can be made within 90 days after initial transaction was made.


INSTALLATION
------------

  1. Copy the 'commerce_cardinity' folder into the modules directory
    usually: '/sites/all/modules/'.

  2. In your Drupal site, enable the module under Administration -> Modules
    The module will be in the group Commerce - Payment.

  3. Get a Cardinity credit card processing account on https://cardinity.com

  4. Configure the payment rule at admin/commerce/config/payment-methods
    with your Cardinity API keys.


SUPPORT
------------

If you have any questions on how to use the module, want to report a bug or
request a new feature please contact us info@cardinity.com.