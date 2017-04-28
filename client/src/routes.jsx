import React from 'react';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';

import App from './components/App';
import LoginPage from './components/login/LoginPage';
import Home from './components/home/Home';

import requireAuth from './utils/requireAuth';

//Routes for this app (if any route must be protected wrap it with the function requireAuth(ReactComponent)
export default (
    <Router history={browserHistory}>
        <Route path="/" component={App}>
            <IndexRoute component={LoginPage} />
            <Route path="/admin/home" component={requireAuth(Home)} />
        </Route>
    </Router>
)