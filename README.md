

## About Laravel

I managed to change my entire Laravel E-commerce website which was built via AJAX to Livewire

These are the important points that I was able to apply:
- Dynamic filters on the store page
- Currency converter on the product detail page 
(Update product price in currencies by selecting size) 
- Product evaluation and rating
- Product taxes / GST System
- Shopping cart processes.
- My Wish list.
- Coupon system.
- Multiple delivery addresses to "update shipping charges amount"
- Checkout page
- Cash on delivery (Payment method)
- Cancellation of the order (new order)
- Re-order after cancellation
- Exchange the order after cancellation
- Generate order invoice (order status is delivered)

----
#### Admin Is able to 

- CRUD sections, categories
- CRUD products with a variety of features
  > 1. Each product has attributes like size, stoke, price, SKU, and status 
  > 2. Each product has multi images that display all sides of that product
- CRUD filters with its values and selects the right categories.
- CRUD brands and banners.
- CRUD coupons
  > Coupon has a lot of conditions : 
  > 1. which categories must apply coupon on it?
  > 2. which users must be chosen
  > 3. coupon has an expired date
  > 4. coupon will apply singular or multiple
- CRUD Shipping charges
  > weight from 0-500g has a price 
  > weight from 501-1000g has a price 
  > weight from 1001-2000g has a price 
  > weight from 2001-5000g has a price 
  > weight from above 5000g has a price 
- CRUD currencies converter and apply it when the customer updates product size. 
- Display all user's evaluations of products.
- Display all customers' orders and update their status and send emails to notify them.
- Display all cancellation orders 
- Display all return orders, with an update its status (Approved or Rejected)
- Display all exchange orders, with an update its status (Approved or Rejected)

