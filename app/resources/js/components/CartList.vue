<template>

<div class="container">

<div id="accordion" v-for="cart in carts" :key="cart.id">
  <div class="card">
    <div class="card-header" :id="cart.hash+cart.id">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" :data-target="'#'+cart.hash" aria-expanded="true" :aria-controls="cart.hash">
          <b>#{{cart.id}}</b> - {{cart.hash}} -- Total price: {{cart.totalPrice}}
        </button>
      </h5>
    </div>

    <div :id="cart.hash" class="collapse show" :aria-labelledby="cart.hash+cart.id" data-parent="#accordion">
      <div class="mb-2" >
      <button type="button" class="btn btn-danger"  @click="removeCart(cart.id)">
      <i> Remove Cart <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
      </svg> </i>
      </button>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="product in cart.products">
            <th scope="row">{{product.product.id}}</th>
            <td>{{product.product.name}}</td>
            <td>{{product.quantity}}</td>
            <td v:html="" >{{product.totalPrice}}</td>
            <td><button type="button" class="btn btn-danger" @click="remove(product.id)">remove</button></td>
          </tr>
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
<product-component></product-component>

</div>


</template>

<script>
export default {
  data() {
    return {
      carts: [],
      totalPrice: 0
    };
  },
  created() {
    this.getData(null);
  },
  methods: {
    remove(pid) {
    axios
      .delete("api/productscart/"+pid)
      .then((response) => {
      console.log(response)
      this.getData()
    }).catch((error) => {
        // handle error
        console.error(error);
      });
      },
    removeCart(cid) {
    axios
      .delete("api/carts/"+cid)
      .then((response) => {
      console.log(response)
      this.getData()
    }).catch((error) => {
        // handle error
        console.error(error);
      });
      },
    getData() {
    axios
      .get("api/carts")
      .then((response) => {
      this.carts = []
      for(let i = 0; i < response.data.data.original.length; i++) {

        let data = response.data.data.original[i]
        let totalCartPrice = 0
        //calculate the amount
          for(let i = 0; i < data.products.length; i++) {
            let product = data.products[i].product
            let quantity = data.products[i].quantity
            let totalPrice = product.price.price * quantity
            totalCartPrice = totalCartPrice + totalPrice;
            data.products[i].totalPrice = totalPrice.toFixed(2).replace(".",",") + " €"

          }

        this.carts.push({
          id : data.id,
          hash: data.hash,
          updated_at: data.updated_at,
          products: data.products,
          totalPrice: totalCartPrice.toFixed(2).replace(".",",") + " €"
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
