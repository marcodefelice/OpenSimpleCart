<template>

<div>
<h1>Product list</h1>
<div class="row">
<input type="hidden" name="cart_id" id="cart_id" value="0" />
<div class="card-deck mb-2 mr-2"
v-for="product in products"
:key="product.id">
  <div class="card mr-2 mb-2">
    <div class="card-body">
      <h5 class="card-title">{{product.name}}</h5>
      <p class="card-text">{{product.description}}.</p>
      <p><b>{{product.price}}</b></p>
      <button @click="addtocart(product)" class="btn btn-primary">Add To Cart</button>
    </div>
  </div>
</div>
</div>
</div>
</template>

<script>
export default {
  data() {
    return {
      products: [],
      cartId: 0,
    };
  },
  created() {
    this.getData(null);
  },
  mounted() {
    this.cartId = document.getElementById("cart_id").value
  },
  methods: {
    addtocart(product) {
      axios
        .post("api/productscart",{
          product_id: product.id,
          quantity: 1,
          cart_id: this.cartId
        })
        .then((response) => {
          this.cartId = response.data.original.cart_id
          this.$parent.getData();
        })
        .catch((error) => {
          // handle error
          console.error(error);
        });
    },
    getData(cat) {
      let path = "/api/products";
      axios
        .get(path)
        .then((response) => {
          for(let i = 0; i < response.data.data.original.length; i++) {
          let data = response.data.data.original[i]
              this.products.push({
                id : data.id,
                sku: data.sku,
                name: data.name,
                description: data.description,
                price: data.price.label
              });
          }
        })
        .catch((error) => {
          // handle error
          console.error(error);
        });
    },
  },
};
</script>
