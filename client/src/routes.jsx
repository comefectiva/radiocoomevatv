import React from 'react';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';
import {getVideos} from './actions/videoActions';

//Page Components
import App from './components/App';
import Home from './components/Home';
import Video from './components/Video';
//Admin Components
import AdminApp from './components/admin/App';
import LoginPage from './components/admin/login/LoginPage';
import AdminHome from './components/admin/video/VideoList';
import AdminCreateVideo from './components/admin/video/CreateVideo';

import requireAuth from './utils/requireAuth';

const videoRoutes = getVideos();
//Routes for this app (if any route must be protected wrap it with the function requireAuth(ReactComponent)
export default (
    <Router history={browserHistory}>
        <Route path="/admin" component={AdminApp}>
            <IndexRoute component={LoginPage} />
            <Route path="home" component={requireAuth(AdminHome)} />
            <Route path="video/new" component={requireAuth(AdminCreateVideo)} />
        </Route>
        <Route path="/" components={App}>
            <IndexRoute component={Home} />
            <Route path="*" component={Video} />
        </Route>
    </Router>
)