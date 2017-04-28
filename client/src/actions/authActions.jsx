import axios from 'axios';
import setAuthorizationToken from '../utils/setAuthorizationToken';
import { SET_CURRENT_USER } from './types';
import jwtDecode from 'jwt-decode';

// Set the user in localStorage using his reducer
export function setCurrentUser(user){
    return {
        type: SET_CURRENT_USER,
        user: user
    }
}

// Destroy the token from localStorage and the request Headers
export function logout(){
    return dispatch => {
        localStorage.removeItem('jwtToken');
        setAuthorizationToken(false);
        dispatch(setCurrentUser({}));
    }
}

// Create a new Token and set header with it
export function login(data){
    return dispatch => {
        return axios.post(`/api/login`, data).then(res => {
            const token = res.data.token;
            localStorage.setItem('jwtToken', token);
            setAuthorizationToken(token);
            dispatch(setCurrentUser(jwtDecode(token)));
        });
    }
}