<template>
	<div class="contact">
		
		<p>Details</p>
		
		
		
		<!------ Mine, Just to check if Store is working and connected --------->
		<!-- Gets Vuex store from store/index.js -->
		<!-- Foreach -->	
		<span v-for="productX in checkStore" :key="productX.productId"> 
        {{  productX.productId }} {{ productX.productTitle }}  
        </span>
		<!------ Mine, Just to check if Store is working and connected --------->
	    
		
		
		
		
		<!-- Show one product, based on URL ID. Gets values from Vuex store in "/store/index.js" -->
		<!-- {{  this.$store.state.products[this.currentDetailID].productId }} == same ==> {{  checkStore[this.currentDetailID].productId }} == same as(if used {...mapState(['products']),}) ==> products[this.currentDetailID].productId-->
		<div>
		    <hr>
		    <p> One product </p>
		    <p>{{  this.$store.state.products[this.currentDetailID].productId }} {{ this.$store.state.products[this.currentDetailID].productTitle }}</p>
            <img :src="`images/${this.$store.state.products[this.currentDetailID].image}`" class="card-img-top my-img">
		</div>
		<!-- Show one product, based on URL ID -->
	    
		<br><br>
	</div>
</template>


<script>
import { mapState } from 'vuex';
export default {
  name: 'details',
  data() {
    return {
      //postDialogVisible: false,
	  currentDetailID: 1, 
    };
  },
  
  //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.
  computed: {
	 ...mapState(['products']), //works without it???? => FALSE.//is needed for Vuex store, after it u may address Vuex Store value as {products} instead of {this.$store.state.products}

	 
	//mine test
	checkStore() {
        console.log(this.$store.state.products); //Gets values from Vuex store in "/store/index.js" 
		return this.$store.state.products;
      },
	//mine  
  },
  
  //before mount
  beforeMount() {
     console.log(this.$store.state.products);
	 
	 //getting route ID => e.g "wpBlogVueFrameWork#/details/2", gets 2. {Pid} is set in 'pages/home' in => this.$router.push({name:'details',params:{Pid:proId}})
	 var ID = this.$route.params.Pid; //gets 2
	 ID = ID - 1; //to comply with Vuex Store array, that starts with 0
	 this.currentDetailID = ID; //set to this.state
   },
   }
</script>

<style scoped>
.contact form{
	max-width: 40em;
	margin: 2em auto;
}
.contact form .form-control{
	margin-bottom: 1em;
}
.contact form textarea{
	min-height: 20em;
}	
</style>