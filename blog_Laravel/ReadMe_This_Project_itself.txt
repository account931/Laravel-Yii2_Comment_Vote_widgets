Table of content:
1. To do list of features to implement in future.
2. ShopSimple
3. 


=================================================


1. To do list of features to implement in future.
  1.add Db table sh_product column Device type, eg "Turntable, flashdrive etc" and implement in autocomple search 
  2. Controll Db table Product sh_product column Quantity (in modal, cart with Js, while adding to Session with Php.


=================================================
2. ShopSimple
#Controller ShopPayPalSimpleController/ function index ()
 builds a list of all DB products with pagination by loop using Render Partial	template:
@for ($i = 0; $i < count($allDBProducts); $i++)	
  <!-- Show One product with hidden modal (by Render Partial) --> 
  @include('ShopPaypalSimple.partial.oneProduct_with_hiddenModal', ['i' => $i, 'allDBProducts' => $allDBProducts ]) 

This creates a one div with one hidden modal. When u click "Add to cart" in hidden modal, <form> brings you to 
public function storeToCart(Request $request) which saves product id and quantity to $_SESSION['cart_dimmm931_1604938863'].

#Cart displays $_SESSION['cart_dimmm931_1604938863'] in <form> values, while u can ++/-- quantity values with JS. 
When u click "Check-out", form inputs are sent via Post and those inputs are used to totally renew
$_SESSION['cart_dimmm931_1604938863'] in function checkOut(Request $request)