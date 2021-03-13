<!-- https://github.com/hayanisaid/Vue-router -->
<!-- Vue-Router Main menu with Links -->

<template>
  <div id="appDemo">
  
      <!-- navbar -->
      <div class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
	  
        <div class="container">
            <router-link to="/" class="navbar-brand">Home</router-link>
			
			
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
            </button> 
			

			
           <div class="collapse navbar-collapse" id="navbarResponsive">
              <ul class="navbar-nav">
      
                 <li class="nav-item">
                    <router-link class="nav-link" to="/blog">Blog</router-link>
                 </li>
                 <li class="nav-item">
                    <router-link class="nav-link" to="/services">Services</router-link>
                 </li>
                 <li class="nav-item">
                    <router-link class="nav-link" to="/contact">Contact</router-link>
                 </li>
             </ul>
           </div> <!-- end  id="navbarResponsive" -->
		
        </div>
      </div>
	  <!-- End navbar -->
	  

<!-- Variant 2 -->	 
<!-- 
<nav class="navbar bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" aria-expanded="false">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="navbar-collapse collapse" id="collapsibleNavbar" style="">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="javascript:void(0)">Link</a>
      </li>    
    </ul>
  </div>  
</nav>
-->
<!-- Variant 2 -->	



<!--- Variant 3  -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Page 1-1</a></li>
            <li><a href="#">Page 1-2</a></li>
            <li><a href="#">Page 1-3</a></li>
          </ul>
        </li>
        <li><a href="#">Page 2</a></li>
        <li><a href="#">Page 3</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>
    </div>
  </div>
</nav>



<!--- Variant 4 --->
<nav class="navbar navbar-inverse">
  <ul class="nav navbar-nav">
    <li class="nav-item"> <router-link class="nav-link" to="/home">Home</router-link> </li>
	<li class="nav-item"> <router-link class="nav-link" to="/blog">Blog</router-link> </li>
    <li class="nav-item"> <router-link class="nav-link" to="/services">Services</router-link> </li>
    <li class="nav-item"><router-link class="nav-link" to="/contact">Contact</router-link> </li>			 
  </ul>
</nav>






	 
	  
	  
	  <!------ Shows the rendered page (home, services, etc) based on selected menu item ------>
      <div class="col-sm-12 col-xs-12 container ">
       <transition name="moveInUp">
         <router-view/>
       </transition>
      </div>
	  <!------ End Shows the rendered page (home, services, etc) based on selected menu item ------>
    
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
/* mine */
.nav-item   {margin-left:2em; }
.nav-item a {color:black;}
.navbar-brand {color:black}

#appDemo {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
.moveInUp-enter-active{
  animation: fadeIn 2s ease-in;
}
@keyframes fadeIn{
  0%{
    opacity: 0;
  }
  50%{
    opacity: 0.5;
  }
  100%{
    opacity: 1;
  }
}
.moveInUp-leave-active{
  animation: moveInUp .3s ease-in;
}
@keyframes moveInUp{
 0%{
  transform: translateY(0);
 }
  100%{
  transform: translateY(-400px);
 }
}
</style>