import React from 'react';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';

//Page Components
import App from './components/App';
import Video from './components/video/VideoPage';
import Home from './components/home/Home';
//Admin Components
import AdminApp from './components/admin/App';
import LoginPage from './components/admin/login/LoginPage';
import AdminHome from './components/admin/video/VideoList';
import AdminCreateVideo from './components/admin/video/CreateVideo';
import EditVideo from './components/admin/video/EditVideo';

import requireAuth from './utils/requireAuth';
import Player from "./components/player/Player";

//Routes for this app (if any route must be protected wrap it with the function requireAuth(ReactComponent)
export default (
    <Router history={browserHistory}>
        <Route path="/admin" component={AdminApp}>
            <IndexRoute component={LoginPage} />
            <Route path="videos" component={requireAuth(AdminHome)} />
            <Route path="video/new" component={requireAuth(AdminCreateVideo)} />
            <Route path="video/update/:id" component={requireAuth(EditVideo)}/>
        </Route>
        <Route path="/" components={App}>
            <IndexRoute component={Home} />
            <Route path="player" components={Player}/>
        </Route>
    </Router>
)