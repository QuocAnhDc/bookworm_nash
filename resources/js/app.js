import React from 'react';
import ReactDOM from 'react-dom';
import { HashRouter as Router, Route, Switch, Redirect } from "react-router-dom";

import '../scss/app.scss';
import "bootstrap/dist/css/bootstrap.min.css";
import 'font-awesome/css/font-awesome.min.css';

import { Provider } from "react-redux";
import { createStore } from "redux";

import Header from "./component/header";
import Banner from "./component/home/banner"

//call reducer
import reducers from "./reducers/index";

const store = createStore(
    reducers,
    window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__());

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
                            </Route>
                        </Switch>
                    </div>
                </Router>
            </Provider>
        );
    }
}

const render = () => ReactDOM.render(<App />, document.getElementById("root"));

render();
