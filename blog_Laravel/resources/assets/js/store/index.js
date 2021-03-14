//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
  state: {
	  //posts used in Vue blog
	  posts: [],
      //posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1"}, {"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
      
	  //products are used in Router example
	  products:[
	      {productTitle:"ABCN", image: 'product1.png', productId:1},
          {productTitle:"KARMA",image: 'product2.png', productId:2},
          {productTitle:"Tino", image: 'product3.png', productId:3},
          {productTitle:"EFG",  image: 'product4.png', productId:4},
          {productTitle:"MLI",  image: 'product5.png', productId:5},
          {productTitle:"Banan",image: 'product6.png', productId:6}
        ],
  },
  


  
    actions: {
		/*
	    async getAllPosts({ commit }) { 
	      return commit('setPosts', await fetch('http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all') )
          //return commit('setPosts', await api.get('/post/get_all'))
      }, */
	  
	  //ajax request, get REST API located at => WpBlog_VueContoller/ function getAllPosts()
	  getAllPosts({ commit }) { 
	      $('.loader-x').fadeIn(800); //show loader
		  
          fetch('post/get_all', { //http://localhost/Laravel+Yii2_comment_widget/blog_Laravel/public/post/get_all
              method: 'get',
              headers: { 'Content-Type': 'application/json' },
          }).then(response => {
			  setTimeout(function(){ $('.loader-x').fadeOut(800); }, 1000); //hide loader
              return response.json();
          }).then(dataZ => {
              //console.log(dataZ);
		      //core rewritten async getAllPosts, trigger mutation setPosts()
	          return commit('setPosts', dataZ ); //sets ajax results to store via mutation
          })
	      .catch(err => alert("Getting articles failed ( in store/index.js). Check if ure logged =>  " + err)); // catch any error
      },
	  
	  //working example how to change Vuex store from child component
	  /*
	  changeVuexStoreFromChild({ commit }, dataTestX) { 
	      //var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	      console.log(dataTestX);
		  return commit('setPosts', dataTestX ); //sets dataTestX to store via mutation
	  } 
	  */
	},



  mutations: {
    setPosts(state, response) { 
      state.posts = response.data/*.data*/;
	  console.log('setPosts executed in store' + response);
    },
  },
  strict: debug
});




  


	 
 
 
