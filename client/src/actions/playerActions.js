import axios from 'axios';


export function getSource(params){
    return () => {
        return axios.get(`http://108.163.147.73/radio-new/public/api/v1.0/${params}/get-source`);
    }
}