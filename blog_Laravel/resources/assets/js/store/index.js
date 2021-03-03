//Vuex store
import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

//Vuex store itself
export default new Vuex.Store({
  state: {
	  posts: [],
    //posts: [{"wpBlog_id":1,"wpBlog_title":"Guadalupe Runolfsdottir", "wpBlog_text":"Store text 1"}, {"wpBlog_id":2,"wpBlog_title":"New", "wpBlog_text":"Store text 2"}],
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
              console.log(dataZ);
		      //core rewritten async getAllPosts, trigger mutation setPosts()
	          return commit('setPosts', dataZ );
          })
	      .catch(err => alert("Getting articles failed ( in store/index.js). Check if ure logged =>  " + err)); // catch any error
      }
	},



  mutations: {
    setPosts(state, response) { 
      state.posts = response.data/*.data*/;
	  console.log('setPosts executed in store');
    },
  },
  strict: debug
});




  


	 
 
 
