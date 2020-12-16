Table of content:
1. To do list of features to implement in future.
2. ShopSimple
2. ShopSimple SQL DB tables
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




=================================================
2. ShopSimple SQL DB tables

# Shop works on following SQL DB tables:
     # shop_simple => product and its fields (image, description, price, category (Foreign Key), etc )
	 # shop_categories
	 # shop_orders_main => this DB table that stores general info about one user's order (uuid, items in order, general $ amount, status name, email, etc )
	 # shop_order_item =>  this DB table is used to store a one user's order split by items, ie if Order contains 2 items (dvdx2, iphonex3). 
	 # shop_transactions
	 # shop_quantity_stock ?????
