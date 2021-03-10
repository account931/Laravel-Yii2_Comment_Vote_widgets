<template>





  <div class="row">
  
  
  
    <!------ Mine, Just to check if Store is working and connected --------->
    <div> 
	     <p class="visible-xs" style="margin-top:5em;"></p> <!-- visible in mobile only, for margin -->
         <p>My Store-2 (display all Vuex store, works OK, just commented)</p> 
		  {{ /* checkStore */ }} 
    </div>
	
    <!-- Foreach -->	
	<!--<div v-for="book in checkStore" :key="book.wpBlog_id"> 
        {{  book.wpBlog_id }} {{ book.wpBlog_title }}
    </div>-->
	<hr><h2>Original Posts from Store Vuex</h2>
    <!-------- Mine, Just to check if Store is working and connected  --------->
 
 

									
 
  
    <!-- Original -->
    <div class="col-md-6" v-for="(post, i) in posts" :key=i>
      <div class="card mt-4">
	    
	
        <!-- Show 1st image if exists. HasMany Relation. {get_images} is a model {function getImages()}  HasMany Relation -->		 
        <!--<img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />-->
		
		<!-- Image with LightBox -->
	    <a v-if="post.get_images.length" :href="`images/wpressImages/${post.get_images[0].wpImStock_name}`"   title="image" :data-lightbox="`roadtrip${post.wpBlog_id}`" > <!-- roadtrip + currentID, to create a unique data-lightbox name, so in modal LightBox will show images related to this article only, not all -->
           <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />
	    </a>
        <!-- End Image with LightBox -->
		
        <div class="card-body">
          <p class="card-text"><strong>{{ post.wpBlog_title }}</strong> <br>
            {{ truncateText(post.wpBlog_text) }}
          </p>
        </div>
	
        <button class="btn btn-success m-2" @click="viewPost(i)">View Post</button>
		<hr>
      </div>
    </div>
	
	
	
	<!-- Hidden modal window {ElementUI 'element-ui}(installed separately by npm) , will pop-up visible on click showing 1 full article -->
    <el-dialog v-if="currentPost" :visible.sync="postDialogVisible" width="80%">
      <span>
        <h3>{{ currentPost.wpBlog_title }}</h3>
        <div class="row">
		  
		  <!-- Show all article images. HasMany Relation -->
          <div class="col-md-6" v-for="(img, i) in currentPost.get_images" :key=i>
            <img :src="`images/wpressImages/${img.wpImStock_name}`" class="img-thumbnail" alt="">
          </div>
		  
        </div>
        <hr>
        <p> Text:    {{ currentPost.wpBlog_text }}</p>
		<p> Author:  {{ currentPost.author_name.name }}</p>                 <!-- {author_name}    is a model {function authorName}    BelongsTo relation -->
        <p>Category: {{ currentPost.category_names.wpCategory_name  }}</p>  <!-- {category_names} is a model {function categoryNames} BelongsTo relation -->

	  </span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="postDialogVisible = false">Okay</el-button>
      </span>
    </el-dialog>
    <!-- END Hidden modal window {ElementUI 'element-ui}(installed separately by npm) , will pop-up visible on click showing 1 full article -->

	
	
	
  </div>
</template>

<script>
import { mapState } from 'vuex';
export default {
  name: 'all-posts',
  data() {
    return {
      postDialogVisible: false,
      currentPost: '',
    };
  },
  
  //computed property is used to declaratively describe a value that depends on other values. When you data-bind to a computed property inside the template, Vue knows when to update the DOM when any of the values depended upon by the computed property has changed.
  computed: {
    ...mapState(['posts']), //works without it????
	
	//mine test
	checkStore() {
        console.log(this.$store.state.posts);
		return this.$store.state.posts;
		//return [{"wpBlog_id":1,"wpBlog_title":"Article 1", "wpBlog_text":"Text 1"}, {"wpBlog_id":2,"wpBlog_title":"Article 2", "wpBlog_text":"Text 2"}]
      },
	//mine  
  },
  
  //before mount
  beforeMount() {
    ////run ajax in Vuex store
    this.$store.dispatch('getAllPosts'); //trigger ajax function getAllPosts(), which is executed in Vuex store
	
   /*
    //working example how to change Vuex store from child component   
	var dataTest = {"error":false,"data":[{"wpBlog_id":1,"wpBlog_title":"Dima", "wpBlog_text":"Store 1", "get_images":[]}, {"wpBlog_id":2,"wpBlog_title":"Dima 2", "wpBlog_text":"Store 2", "get_images":[]}]};
	this.$store.dispatch('changeVuexStoreFromChild', dataTest); //working example how to change Vuex store from child component
   */
  },
  methods: {
    truncateText(text) {
      if (text.length > 24) {
        return `${text.substr(0, 24)}...`;
      }
      return text;
    },
	//set currentPost for viewing one article
    viewPost(postIndex) {
      const post = this.posts[postIndex];
      this.currentPost = post;
      this.postDialogVisible = true;
    }
  },
}
</script>