import { combineReducers } from 'redux';
import flashMessages from './reducers/flashMessages';
import auth from './reducers/auth';

//Mix the reducers for this app in the localStorage
export default combineReducers({
    flashMessages,
    auth
});