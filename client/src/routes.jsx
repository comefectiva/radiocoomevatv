import React from 'react';
import { Router, Route, IndexRoute, browserHistory } from 'react-router';

//Page Components
import App from './components/App';
import Home from './components/home/Home';
import Video from './components/video/Video';
//Admin Components
import AdminApp from './components/admin/App';
import LoginPage from './components/admin/login/LoginPage';
import AdminHome from './components/admin/video/VideoList';
import AdminCreateVideo from './components/admin/video/CreateVideo';
import EditVideo from './components/admin/video/EditVideo';
import VideoListDatabase from './components/admin/customLogin/VideoListDatabase';
import AttachDB from './components/admin/customLogin/AttachDB';

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
            <Route path="db" component={requireAuth(VideoListDatabase)}/>
            <Route path="db/:id" component={requireAuth(AttachDB)}/>
        </Route>
        <Route path="/" components={App}>
            <IndexRoute component={Home} />
            <Route path="player" components={Player}/>
        </Route>

        <Route path="/video/*" components={Video}/>
    </Router>
)