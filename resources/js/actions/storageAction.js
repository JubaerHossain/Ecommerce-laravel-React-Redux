import axios from 'axios';
import {GET_ERRORS, GET_STORAGE,GET_WARHOUSE} from './types';

export const getStorage  = () => dispatch => {
    axios.get('/api/merchant-warehouses')
    .then(res => {  
              
        dispatch({
            type: GET_STORAGE,
            payload: res.data
        })    }
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}
export const getWarhouse  = () => dispatch => {
    axios.get('/api/storage')
    .then(res => {
                
        dispatch({
            type: GET_WARHOUSE,
            payload: res.data
        })    }
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    );
}