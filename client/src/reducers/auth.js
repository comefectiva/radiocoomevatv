import { SET_CURRENT_USER } from '../actions/types';
import isEmpty from 'lodash/isEmpty';

// Set the initial state for the localStorage
const initialState = {
    isAuthenticated: false,
    user: {}
};

// Export this function to handle the action dispatcher and update the redux state
export default (state = initialState, action = {}) => {
    switch (action.type){
        case SET_CURRENT_USER:
            return {
                isAuthenticated: !isEmpty(action.user),
                user: action.user
            };
        default: return state;
    }
}