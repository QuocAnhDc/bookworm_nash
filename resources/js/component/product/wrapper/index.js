import React from 'react';
import './style.scss';

import { withRouter } from 'react-router';


import {getQueryVariable} from '../../../utils/queryVariable';

import qs from 'query-string';

class WrapperProduct extends React.Component {

    constructor(props) {
        super(props);
    }
    componentDidMount() {
    }

    render() {
        return (
            // WRAPPER - SHOP
            <div className="wrapper-shop">
                <h1>Product here</h1>
            </div>
        )
    }
}

export default withRouter(WrapperProduct);
