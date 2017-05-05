import axios from 'axios';

export function getTop10(radio){

    return () => {
        return axios.get('/api/top10', {
            params: {radio}
        });
    }
}