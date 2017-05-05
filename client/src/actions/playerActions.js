import axios from 'axios';
import { RADIO_PLAYING_STATUS } from './types';

export function setRadioPlayerStatus(status){
    return {
        type: RADIO_PLAYING_STATUS,
        user: status
    }
}

export function playerGlobalHandler(status){
    return dispatch => {
        dispatch(setRadioPlayerStatus(status));
    }
}

export function getRadioList(){
    return () => {
        return axios.get('/api/radios');
    }
}

export function getSource(id){
    return () => {
        return axios.get('/api/radios', {
            params: {id}
        });
    }
}

export function getSourceInfo(params){
    return () =>{
        return axios.post('/api/radios/info', params);
    }
}