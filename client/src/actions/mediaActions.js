import axios from 'axios';
import { UPLOAD_DOCUMENT_SUCCESS, UPLOAD_DOCUMENT_FAIL } from './types';

export function uploadSuccess({ data }) {
    return {
        type: UPLOAD_DOCUMENT_SUCCESS,
        data,
    };
}

export function uploadFail(error) {
    return {
        type: UPLOAD_DOCUMENT_FAIL,
        error,
    };
}

export function uploadDocumentRequest(file) {
    let data = new FormData();
    data.append('media', file);
    return (dispatch) => {
        return axios.post('/api/media', data)
    };
}

export function uploadDB(file, video){
    let data = new FormData();
    data.append('csv', file);
    data.append('video', video);
    data.append('pass', '1234');
    return (dispatch) => {
        return axios.post('/api/custom-login', data)
    };
}

export function getMedia(id){
    return () => {
        return axios.get('/api/media', {
            params: {id}
        })
    }
}