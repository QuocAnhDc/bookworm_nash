import React from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Switch, Redirect } from "react-router-dom";

// css, bootstrap, front-awesome
import '../scss/app.scss';
import "bootstrap/dist/css/bootstrap.min.css";
import 'font-awesome/css/font-awesome.min.css';

import { Provider } from "react-redux";
import { createStore } from "redux";

import Header from "./component/header";
import Footer from "./component/footer";


//home page

import Banner from "./component/home/banner"
import Wrapper from "./component/home/wrapper";

// about page
import About from "./component/about";

// auth page
import Auth from "./component/login";

import WrapperProduct from './component/product/wrapper';
//call reducer
import reducers from "./reducers/index";

const store = createStore(reducers);

class App extends React.Component {
    render() {
        return (
            <Provider store={store}>
                <Router>
                    <div className="App">
                        <Header/>
                        <Switch>
                            <Route exact path="/">
                                <Banner/>
                                <Wrapper/>
                            </Route>
                            <Route exact path="/detail/:idBook">
                                <WrapperDetail />
                            </Route>
                            <Route exact path="/product/:redirectParams">
                                <WrapperProduct />
                            </Route>
                            <Route exact path="/about">
                                <About/>
                            </Route>
                            <Route exact path="/login">
                                <Auth/>
                            </Route>
                        </Switch>
                        <Footer/>
                    </div>
                </Router>
            </Provider>
        );
    }
}

const render = () => ReactDOM.render(<App />, document.getElementById("root"));

render();
