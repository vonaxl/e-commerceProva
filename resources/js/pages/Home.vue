<template>
    <div>
        <!-- <Carousel /> -->
        <div class="row justify-content-around">
            <router-link
                v-for="product in products"
                v-bind:key="product.id"
                :to="'/show/' + product.id"
                class="col-12 col-sm-2 col-md-4"
            >
                <b-card
                    :title="product.name"
                    img-src="https://picsum.photos/600/300/?image=25"
                    img-alt="Image"
                    img-top
                    tag="article"
                    class="mb-2"
                >
                    <b-card-text>Card text</b-card-text>
                </b-card>
            </router-link>
        </div>
        <!-- <ul class="list-unstyled">
    <li >{{ product.name }}</li>
    </ul>-->
    </div>
</template>

<script>
import Carousel from "../components/Carousel";
export default {
    components: {
        Carousel
    },
    data() {
        return {
            products: []
        };
    },
    created() {
        const _this = this;
        axios
            .get("http://127.0.0.1:8000/api/products")
            .then(function(res) {
                console.log(res.data);
                _this.products = res.data;
            })
            .catch(error => console.log(error));
    }
};
</script>

<style></style>
