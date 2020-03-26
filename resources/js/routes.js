import Home from "./pages/Home";
import Register from "./pages/Register";
export default [
    
    {
        path: "/register",
        component: Register,
        name : "register"
    },
    {
        path: "/",
        name: "home",
        component: Home
    },
    /* {
        path: "/search/:navSearch",
        name: "resultSearch",
        component: Search
    },
    {
        path: "/show/:id",
        name: "showProduct",
        component: Show
    } */

]