<template>
  <div :key="componentKey" class="card mt-4">
    <div class="card-header">
      New Post
    </div>
    <div class="card-body">
      <div
        v-if="status_msg"
        :class="{ 'alert-success': status, 'alert-danger': !status }"
        class="alert"
        role="alert"
      >
        {{ status_msg }}
		
      </div>
	  
	  
	  
      <form>
	    <input type="hidden" name="_token" :value="tokenXX" /> <!-- csfr token -->
		<!--<input type="hidden" name="_token" value="4gyBcsEYlPibNHfhi1r55rRQAZkBWepxCmVLlqAW" />-->
		
		
        <div class="form-group">
          <label for="exampleFormControlInput1">Title</label>
          <input
            id="title"
            v-model="title"
            type="text"
            class="form-control"
            placeholder="Post Title"
            required
          >
        </div>
        <div class="form-group">
          <label for="exampleFormControlTextarea1">Post Content</label>
          <textarea id="post-content" v-model="body" class="form-control" rows="3" required />
        </div>
        <div class>
          <el-upload
            action="https://jsonplaceholder.typicode.com/posts/"
            list-type="picture-card"
            :on-preview="handlePictureCardPreview"
            :on-change="updateImageList"
            :auto-upload="false"
          >
            <i class="el-icon-plus" />
          </el-upload>
          <el-dialog :visible.sync="dialogVisible">
            <img width="100%" :src="dialogImageUrl" alt>
          </el-dialog>
        </div>
      </form>
    </div>
    <div class="card-footer">
      <button
        type="button"
        class="btn btn-success"
        @click="createPost"
      >
        {{ isCreatingPost ? "Posting..." : "Create Post" }}
      </button>
    </div>
  </div>
</template>

<style>
.avatar-uploader .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  position: relative;
  overflow: hidden;
}
.avatar-uploader .el-upload:hover {
  border-color: #409eff;
}
.avatar-uploader-icon {
  font-size: 28px;
  color: #8c939d;
  width: 178px;
  height: 178px;
  line-height: 178px;
  text-align: center;
}
.avatar {
  width: 178px;
  height: 178px;
  display: block;
}
</style>

<script>
import { mapActions } from 'vuex'
export default {
  name: 'CreatePost',
  data () {
    return {
      dialogImageUrl: '',
      dialogVisible: false,
      imageList: [],
      status_msg: '',
      status: '',
      isCreatingPost: false,
      title: '',
      body: '',
      componentKey: 0,
	  tokenXX:'',
    }
  },
  computed: {},
  mounted () {
      let token = document.head.querySelector('meta[name="csrf-token"]'); //gets meta tag with csrf
      //alert(token.content);
	  this.tokenXX = token.content; //gets csrf token and sets it to data.tokenXX
  },
  methods: {
    ...mapActions(['getAllPosts']),
    updateImageList (file) {
      this.imageList.push(file.raw)
    },
	
    handlePictureCardPreview (file) {
      this.dialogImageUrl = file.url
      this.imageList.push(file)
      this.dialogVisible = true
    },
	
    createPost (e) {
      e.preventDefault();
      if (!this.validateForm()) {
        return false;
      }
	  
	  //Form //PROBLEM HERE
      const that = this;
      this.isCreatingPost = true;
      const formData = new FormData();
      formData.append('title', this.title);
      formData.append('body', this.body);
      /*$.each(this.imageList, function (key, image) {
        formData.append(`images[${key}]`, image);
      }); */
	  
	   console.log(formData);
	   
	  //SENDING AJAX 
      /* api
        .post('/post/create_post', formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        }) 
		*/
		
		$.ajax({
                          
		    url: 'post/create_post_vue', 
            type: 'POST', //POST is to create a new user
			//crossDomain: true,
			
			contentType:"application/json; charset=utf-8",						  
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            contentType: 'application/x-www-form-urlencoded; charset=utf-8',	  
            
			//contentType: false,
            //processData: false,

			//dataType: 'json', //In Laravel causes crash!!!!!// without this it returned string(that can be alerted), now it returns object
						   
			//passing the data
            data: //dataX//JSON.stringify(dataX)  ('#createNew').serialize()
		    {   
                _token: this.tokenXX, //csrf token	
                title: this.title,	
                body: this.body,				
			},
            success: function(data) {
                            
                alert(JSON.stringify(data, null, 4));
			                
            },  //end success
			error: function (error) {
			    alert(JSON.stringify(error, null, 4));
                console.log(error);
			}	  
            });                             
            //END AJAXed  part 
		    return false;
		
		
		//my fix instead of api.post
		fetch('post/create_post_vue', formData, { 
              method: 'POST',
		      
			  //headers: { 'Content-Type': 'application/x-www-form-urlencoded'},
              //contentType: 'application/x-www-form-urlencoded; charset=utf-8',
			  //data :   {//'_token': document.head.querySelector('meta[name="csrf-token"]').content,},
		})
        .then((res) => { 
		  console.log(res);
          this.title = this.body = ''
          this.status = true
          this.showNotification('Post Successfully Created. REWRITE function createPost(Request $request) without transactions')
          this.isCreatingPost = false
          this.imageList = []
          /*
           this.getAllPosts() can be used here as well
           note: "that" has been assigned the value of "this" at the top
           to avoid context related issues.
           */
          that.getAllPosts()
          that.componentKey += 1
        })
    },
	
	
	
	
    validateForm () {
      // no vaildation for images - it is needed
      if (!this.title) {
        this.status = false
        this.showNotification('Post title cannot be empty')
        return false
      }
      if (!this.body) {
        this.status = false
        this.showNotification('Post body cannot be empty')
        return false
      }
      return true
    },
    showNotification (message) {
      this.status_msg = message
      setTimeout(() => {  //clears message in n seconds
        this.status_msg = ''
      }, 3000 * 155)
    }
  }
}
</script>