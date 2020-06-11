import axios from 'axios';
import {GET_DIVISION, GET_DISTRICT} from './types';

export const getDivisions = () => dispatch => {
    axios.get('/api/get-division')
    .then(res => 
        dispatch({
            type: GET_DIVISION,
            payload: res.data
        })
    ).catch(err => 
        dispatch({
            type: GET_DIVISION,
            payload: {}
        })
    );
}
export const getDistricts = (name) => dispatch => {
    axios.get('/api/get-district/'+ name)
    .then(res => 
        dispatch({
            type: GET_DISTRICT,
            payload: res.data
        })
    ).catch(err => 
        dispatch({
            type: GET_DISTRICT,
            payload: {}
        })
    );
}