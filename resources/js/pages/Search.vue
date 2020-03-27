<template>
  <div class="container">
    <h1>Risultati ricerca per: {{ $route.params.navSearch }}</h1>
    <hr />
    <div class="row">
      <div class="col-12 col-md-4">
        <h4>Sidebar</h4>
        <input type="text" v-model="navSearch" />
        <hr />
        <h4>Filters</h4>
        <div>
          <h5>Categories</h5>
          <b-form-select v-model="category" :options="categories" size="sm"></b-form-select>
          <h5>Price</h5>
          <b-form-input id="range-1" v-model="priceRange" type="range" min="1" max="1000"></b-form-input>
          €{{ priceRange }}
        </div>
      </div>
      <div class="col-12 col-md-8">
        <h4>Products list</h4>
        <ul v-if="results.length > 0">
          <li v-for="product in results" v-bind:key="product.id">
            <p>{{ product.name }}</p>
            <p>{{ product.description }}</p>
            <p>€{{ product.price }} | {{ product.quantity }}</p>
            <ul>
              <h6 class="text-uppercase text-success">Reviews</h6>
              <li v-for="review in product.reviews" v-bind:key="review.id">
                <p>{{ review.title }}</p>
                <p>{{ review.body }}</p>
              </li>
            </ul>
            <ul>
              <h6 class="text-uppercase text-danger">Categories</h6>
              <li v-for="category in product.categories" v-bind:key="category.id">
                <p class="text-danger">{{ category.title }}</p>
              </li>
            </ul>
            <ul>
              <h6 class="text-uppercase text-primary">Images</h6>
              <li v-for="image in product.images" v-bind:key="image.id">
                <p>{{ image.path }}</p>
              </li>
            </ul>
          </li>
        </ul>
        <div v-else-if="results.length < 1">
          <img
            src="https://image.freepik.com/free-vector/error-404-found-glitch-effect_8024-4.jpg"
            alt
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Search",
  data() {
    return {
      results: {},
      myParams: {},
      navSearch: null,
      category: null,
      categories: [{ value: null, text: "Any category" }],
      priceRange: null
    };
  },
  created() {
    this.searchProdutcs(this.$route.params.navSearch);
    this.navSearch = null;

    const _this = this;
    axios
      .get("http://127.0.0.1:3000/api/categories/")
      .then(function(res) {
        const data = res.data;
        let value,
          text,
          object = {};
        res.data.forEach(element => {
          value = element.id;
          text = element.title;
          object = { value, text };
          _this.categories.push(object);
        });
      })
      .catch(error => console.log(error));
  },
  watch: {
    navSearch: function(input) {
      clearTimeout(this.timeout);
      const _this = this;
      this.timeout = setTimeout(function() {
        _this.searchProdutcs();
      }, 500);
    },
    category: function() {
      this.searchProdutcs();
    },
    priceRange: function() {
      clearTimeout(this.timeout);
      const _this = this;
      this.timeout = setTimeout(function() {
        _this.searchProdutcs();
      }, 1000);
    }
  },
  methods: {
    searchProdutcs(value) {
      console.clear();

      const _this = this;

      if (value) {
        _this.myParams.navSearch = value;
      }
      if (_this.navSearch != null) {
        _this.myParams.navSearch = _this.navSearch;
      }
      if (_this.category != null) {
        _this.myParams.category = _this.category;
      }
      if (_this.priceRange != null) {
        _this.myParams.price = _this.priceRange;
      }

      axios
        .get("http://127.0.0.1:3000/api/search/", {
          params: _this.myParams
        })
        .then(function(res) {
          _this.results = res.data.products;
          console.log(res);
        })
        .catch(error => console.log(error));
    }
  }
};
</script>

<style></style>
