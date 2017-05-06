import axios from 'axios';

export function getVideos(id){
    return () => {
        if(!id){
            return axios.get('/api/videos');
        }else{
            return axios.get(`/api/videos`, {
                params: { id: id }
            });
        }
    }
}

export function getVideoByUrl(url){
    return() => {
        return axios.get('/api/videos/url', {
            params: {url}
        });
    }
}

export function createVideo(params){
    return () => {
        return axios.post('/api/videos', params);
    }
}

export function editVideo(params){
    return () => {
        return axios.put('/api/videos', params);
    }
}

export function customLoggin(user){
    return () => {
        return axios.get('/api/custom-login/check', {params: {user}});
    }
}