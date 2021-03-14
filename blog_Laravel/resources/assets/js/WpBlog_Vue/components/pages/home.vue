<template>
  <div class="home">
    <h1>{{title}}</h1>
	
    <div class="row fix-for-non-working-click-in-mobile"> <!-- .fix-for-non-working-click-in-mobile is a fix for non-working click in mobile -->
	
      <div class="col-md-4 col-lg4" v-for="(data,index) in products" :key="index">
         <img :src="`images/${data.image}`" class="img-fluid">
         <h3 @click="goTodetail(data.productId)" >{{data.productTitle}}</h3>
      </div>
	  
    </div>
  </div>
</template>

<script>
export default {
  name: 'home',
  data () {
    return {
      title: 'Home',
      products:[
      {
        productTitle:"ABCN",
        image       : 'product1.png',
        productId:1
      },
      {
        productTitle:"KARMA",
        image       : 'product2.png',   //require('../../assets-img/images/product2.png'),
        productId:2
      },
      {
        productTitle:"Tino",
        image       : 'product3.png', //require('../../assets-img/images/product3.png'),
        productId:3
      },
      {
        productTitle:"EFG",
        image       : 'product4.png', //require('../../assets-img/images/product4.png'),
        productId:4
      },
      {
        productTitle:"MLI",
        image       : 'product5.png',  //require('../../assets-img/images/product5.png'),
        productId:5
      },
      {
        productTitle:"Banans",
        image       : 'product6.png', //require('../../assets-img/images/product6.png'),
        productId:6
      }
      ]
    }
  },
  methods:{
  goTodetail(prodId) {
    let proId=prodId
    this.$router.push({name:'details',params:{Pid:proId}})
  }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.row img{
  max-height: 15em;
  width: 100%;
}
.row h3{
  cursor:pointer;
}
</style>