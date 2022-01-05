//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';


Vue.use(Vuex);
const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
    state: {
		randomNine         : [], //store var to keep 9 captcha images, returned by axios to 'api/getCaptchaSet'
		checkCategory      : '',        //selected captcha category for user to choose images
		checkCategoryLength: '', //number of images user has to find
		 
	    //posts used in Vue blog
	    //posts              : [], //posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1", ,"wpBlog_category":4,"wpBlog_status":"1", "get_images":[{"wpImStock_id":16,"wpImStock_name":"product6.png","wpImStock_postID":1,"created_at":null,"updated_at":null}],"author_name":{"id":1,"name":"Admin","email":"admin@ukr.net","created_at":null,"updated_at":null},"category_names":{"wpCategory_id":4,"wpCategory_name":"Geeks","created_at":null,"updated_at":null}}, {"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
        //api_tokenY       : localStorage.getItem('tokenZ') || '' , //api_token is passed from php in view as <vue-router-menu-with-link-content-display v-bind:current-user='{!! Auth::user()->toJson() !!}'>  and uplifted here to this store in VueRouterMenu in beforeMount() Section. Was true in prev project
        //adm_posts_qunatity : 0, //quantity of posts found
        //loggedUser         : JSON.parse(localStorage.getItem('loggedStorageUser')) || {name: 'not set', email: 'errorMail'}, //logged user data (JS type:Object), set by Login ajax, {name: '', email: ''}  use {JSON.parse} to convert string to JS type: OBJECT
        //passport_api_tokenY: localStorage.getItem('tokenZ') || null , // is set by ajax in /subcomponents/login.vue {thatX.$store.dispatch('changeVuexStoreLogged', data); and mutated here by { changeVuexStoreLogged({ commit }, dataTestX) } }
        //ifLogged           : this.getters.fruitsCount,//true,  //() =>ifTokenExists(), //state based on computed //false, //flag whether user logged or not (Passport changes here)
        test: 'mmmm',
        
	    //products are used in Router example. NOT USED IN CLEANSED Version. Set via seeder to DB and extracted via store/index.js ajax
        /*	 
        products:[
	        {productTitle:"ABCN", image: 'product1.png', productId:1},
            {productTitle:"KARMA",image: 'product2.png', productId:2},
            {productTitle:"Tino", image: 'product3.png', productId:3},
            {productTitle:"EFG",  image: 'product4.png', productId:4},
            {productTitle:"MLI",  image: 'product5.png', productId:5},
            {productTitle:"Banan",image: 'product6.png', productId:6}
        ],
        */
    },
  
    
    getters: {
        //minor getter, can delete (both from Login_component)
         getCart: function (state) { //getCart(state) {
            return state.passport_api_tokenY;
        },
        
        isLoggedIn: state => !!state.passport_api_tokenY, //get value (true/false) based on other state
    

    },
    
 

    
   

	


    
    actions: {
		/*
	    async getAllPosts({ commit }) { 
	        return commit('setCaptchaToSore', await fetch('http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all') )
            //return commit('setCaptchaToSore', await api.get('/post/get_all'))
        }, */
	  
        //on Login success save data to Store (trigger mutation)
        changeVuexStoreLogged({ commit }, dataTestX) { 
            return commit('setLoginResults', dataTestX ); //sets dataTestX to store via mutation
        },
        
        //NOT USED HERE??????      
        //working example how to change Vuex store from child component //Catch a passed api token from VueRouterMenu, triggered in beforeMount()
	    changeVuexStoreTokenFromChild({ commit }, dataTestX) { 
	        //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	        alert('store token ' + dataTestX);
		    return commit('setApiToken', dataTestX ); //sets dataTestX to store via mutation
	    },
      
      
	  
           
        /*
        |--------------------------------------------------------------------------
        | Ajax request, get REST API located at => WpBlog_VueContoller/ function getAllPosts(), get random generated captcha set
        |--------------------------------------------------------------------------
        |
        |
        */
	    getCaptchaSet({ commit, state  }) {  //state is a fix
        
            var thatX = this; //to fix context issue

	        $('.loader-x').fadeIn(800); //show loader
            //alert('start (True) Disable 2nd alert in AllPosts beforeMount');
            
            
            // If you prefer Fetch method http variant, see instructions at => getAllPosts({ commit, state  }) => /Laravel_Vue_Blog_V6_Passport/blob/main/resources/assets/js/store/index.js
            
            
            
            //Axios method http variant , to see detailed specifics, see  => /Laravel_Vue_Blog_V6_Passport/blob/main/resources/assets/js/store/index.js

            
            axios({
                method: 'get', //you can set what request you want to be
                url: 'api/getCaptchaSet',
                //data: {id: varID},
                headers: {
                    //'Content-Type': 'application/json', 'Authorization': 'Bearer ' + state.passport_api_tokenY
                },
            })
            /*.then(response => {
                $('.loader-x').fadeOut(800);  //hide loader
                //return response.json(); //Fetch feature //In Axios responses are already served as javascript object, no need to parse, simply get response and access data.
                alert(1);
            }) */
            .then(dataZ => {
                //var dataZ = JSON.stringify(dataVV);
                console.log(dataZ);
                console.log("type is => " + typeof(dataZ));

                $('.loader-x').fadeOut(800);  //hide loader
                //alert(dataZ);
                //console.log("Here STORE => "   + dataZ.data.data[0].wpBlog_title);
                //console.log("Here STORE 2 => " + JSON.stringify(dataZ.data.data)); //works
		        //core rewritten, async getAllPosts, trigger mutation setCaptchaToSore()
                //alert(3);
                console.log("dataZ.error " + dataZ.data.error);
                
                
                //change for Axios
                if (dataZ.data.error == false){  //All Is OK
                    alert('dataZ.data.error 4 ' + dataZ.data.error);
                    swal("Done", "Captcha set is loaded (axios) (Vuex store)", "success");
	                return commit('setCaptchaToSore', dataZ.data ); //sets ajax results to store via mutation
                }
            })
	        .catch(function(err){ 
                $('.loader-x').fadeOut(800);  //hide loader
                console.log("Getting captcha failed ( in store/index.js). Check if ure logged =>  " + err);
                swal("Crashed", "You are in catch", "error");
                alert("err " + err);
                
                //changes for Axios //Unlogg the user 
                if(err == "Error: Request failed with status code 401" ||  err == "Unauthenticated."){ //if Rest endpoint returns any predefined error
                    console.log("dataZ.data.error 2 " + err.error);
                    swal("Unauthenticated2", "Check Bearer Token2", "error");
                    
                    
                }
            }); // catch any error
 
            //End Axios http variant (% working)
      
        },
        
        
       
      
      
      
      
        //For mutation to set a quantity of found posts(in Admin Part). Fired in list_all. passedArgument is an arg passed in list_all.vue
        setCaptchaToSoreQuantity ({ commit, state  }, passedArgument) {  //state is a fix
            return commit('setQuantMutations', passedArgument ); //to store via mutation
        },
	  
	    //working example how to change Vuex store from child component
	    /*
	    changeVuexStoreFromChild({ commit }, dataTestX) { 
	        //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	        console.log(dataTestX);
		    return commit('setCaptchaToSore', dataTestX ); //sets dataTestX to store via mutation
	    } 
	    */
      
	  
	},

    
	/*
     |--------------------------------------------------------------------------
     | Mutation section
     |--------------------------------------------------------------------------
     |
     |
     */

    mutations: {
		
		//sets the store vars, returned by getCaptchaSet({ commit, state  })
        setCaptchaToSore(state, response) {  
            console.log('Set captcha mutation successfully');
            state.randomNine          = response.randomNine;          //set to store 9 captcha images, returned by axios to 'api/getCaptchaSet'
			state.checkCategory       = response.checkCategory;       //set to store selected captcha category for user to choose images
		    state.checkCategoryLength = response.checkCategoryLength; //set to store number of images user has to find
	        console.log('setCaptchaToSore executed in store' + response.checkCategory);
        },
     
    
    },
    strict: debug
});




  


	 
 
 
