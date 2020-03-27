import Home from "./pages/Home";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Search from "./pages/Search";
export default [
    {
        path: "/register",
        component: Register,
        name: "register"
    },
    {
        path: "/",
        name: "home",
        component: Home
    },
    {
        path: "/login",
        name: "login",
        component: Login,
        props: true
    },
    {
        path: "/search/:navSearch",
        name: "resultSearch",
        component: Search
    },
    // {
    //     path: "/show/:id",
    //     name: "showProduct",
    //     component: Show
    // }
];
