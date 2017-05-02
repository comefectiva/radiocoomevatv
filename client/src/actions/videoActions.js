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