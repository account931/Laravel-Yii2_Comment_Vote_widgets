<template>





  <div class="row">
  
  
  
    <!------ Mine, Just to check if Store is working and connected --------->
    <div>
         <p>My Store-2 (works just commented)</p> 
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
	                                                                  
        <img v-if="post.get_images.length" class="card-img-top my-img" :src="`images/wpressImages/${post.get_images[0].wpImStock_name}`" />
		
        <div class="card-body">
          <p class="card-text"><strong>{{ post.wpBlog_title }}</strong> <br>
            {{ truncateText(post.wpBlog_text) }}
          </p>
        </div>
        <button class="btn btn-success m-2" @click="viewPost(i)">View Post</button>
		<hr>
      </div>
    </div>
	
	<!-- Hidden modal to pop-up on click -->
    <el-dialog v-if="currentPost" :visible.sync="postDialogVisible" width="60%">
      <span>
        <h3>{{ currentPost.wpBlog_title }}</h3>
        <div class="row">
		  
		  <!-- Show all article images -->
          <div class="col-md-6" v-for="(img, i) in currentPost.get_images" :key=i>
            <img :src="`images/wpressImages/${img.wpImStock_name}`" class="img-thumbnail" alt="">
          </div>
		  
        </div>
        <hr>
        <p>{{ currentPost.wpBlog_text }}</p>
      </span>
      <span slot="footer" class="dialog-footer">
        <el-button type="primary" @click="postDialogVisible = false">Okay</el-button>
      </span>
    </el-dialog>
	<!-- End Hidden modal to pop-up on click -->
	
	
	
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
  computed: {
    ...mapState(['posts']),
	
	//mine
	checkStore() {
        console.log(this.$store.state.posts);
		return this.$store.state.posts;
		//return [{"wpBlog_id":1,"wpBlog_title":"Article 1", "wpBlog_text":"Text 1"}, {"wpBlog_id":2,"wpBlog_title":"Article 2", "wpBlog_text":"Text 2"}]
      },
	//mine  
  },
  beforeMount() {
    //let that = this;
    this.$store.dispatch('getAllPosts');
  },
  methods: {
    truncateText(text) {
      if (text.length > 24) {
        return `${text.substr(0, 24)}...`;
      }
      return text;
    },
    viewPost(postIndex) {
      const post = this.posts[postIndex];
      this.currentPost = post;
      this.postDialogVisible = true;
    }
  },
}
</script>