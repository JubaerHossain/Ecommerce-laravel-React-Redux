import React, { Fragment } from "react";
import { BrowserRouter as Router, Route, Switch } from "react-router-dom";

import jwt_decode from 'jwt-decode';
import setAuthToken from './utils/setAuthToken';
import {setCurrentUser} from './actions/authActions';
import {restoreOldCart} from './actions/cartAction';
import { Helmet } from 'react-helmet';
import {Provider} from 'react-redux';
import store from './store';

import Navbar from "./components/layout/Navbar";
import Footer from "./components/layout/Footer";
import Landing from "./components/layout/Landing";
import SingleProduct from "./components/single-product/Home";
import Category from "./components/category/Category";
import Register from "./components/auth/Register";
import Login from "./components/auth/Login";
import CategoryProduct from "./components/product/CategoryProduct";
import Notfound from "./components/product/Notfound";

// Customer Dashboard
import Customer from "./components/profile/Profile";

// Dashboard Components
import Dashboard from "./components/dashboard/Index";
import Affiliate from "./components/dashboard/Affiliate";
import Transfer from "./components/dashboard/Transfer";

import Cart from "./components/cart/Cart";
import Checkout from "./components/checkout/Checkout";


import { clearProfile } from "./actions/profileAction";
import PrivateRoute from './components/common/PrivateRoute';


// Check For Old Cart
if(localStorage.cart){
    store.dispatch(restoreOldCart(JSON.parse(localStorage.cart)));
}

// Check For Token
if(localStorage.jwtToken && localStorage.jwtUser){
    // Set auth token header auth
    setAuthToken(localStorage.jwtToken);
    // Decode Json String from storage
    const decodedUser = JSON.parse(localStorage.jwtUser);
    const decodedToken = jwt_decode(localStorage.jwtToken);
    // Set user and  is authenticated
    store.dispatch(setCurrentUser(decodedUser));

    // Check for expired token
    const currentTime = Date.now() / 1000;
    if(decodedToken.exp < currentTime){
        store.dispatch(logoutUser());
        // Clear Current Profile
        store.dispatch(clearProfile());
        //redirect To Login Page
        window.location.href = '/login';
    }
}

const App = () => {
    return (
        <Provider store={store}>
            <Router>
                <Fragment>
                    <Navbar />
                    <div className="container-fluid mainBodyClass" id="mainBody">
                    <Helmet>
                        <meta property="og:url" content="" />
                        <meta property="og:image" content="" itemProp="image" />
                        <meta property="og:image:url" content="" itemProp="image" />
                        <meta property="og:image:width" content="700" />
                        <meta property="og:image:height" content="400" />
                        <meta property="og:description" content="" itemProp="name" />
		        	</Helmet>
                            
                            <Route exact path="/" component={Landing} />
                            <Route exact path="/sign-up" component={Register} />
                            <Route exact path="/sign-in" component={Login} />
                            <Route exact path="/product/:slug/:id?" component={SingleProduct} />
                            <Route exact path="/category-products/:slug" component={CategoryProduct} />
                            <Route exact path="/category/:slug/:string" component={Category} />
                            <Route exact path="/your-shopping-cart" component={Cart} />
                            <Route exact path="/checkout-order" component={Checkout} />
                            <Switch>
                                <PrivateRoute exact path="/profile" component={Customer} />
                                <PrivateRoute exact path="/dashboard" component={Dashboard} />
                                <PrivateRoute exact path="/dashboard/affiliates" component={Affiliate} />
                                <PrivateRoute exact path="/dashboard/transfer" component={Transfer} />
                            </Switch>
                    </div>
                    <div className="clearfix"></div> 
                    <Footer />
                </Fragment>
            </Router>
        </Provider>
    );
}

export default App;
