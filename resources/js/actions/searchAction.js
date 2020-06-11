import axios from 'axios';
import {GET_ERRORS, GET_SEARCH} from './types';

export const getSearch  = (string) => dispatch => {
    
    axios.get(`/api/get-searched-products/${string}`)
    .then(res => {     
        
        dispatch({
            type: GET_SEARCH,
            payload: res.data
        })    }
    )
    .catch(err => 
        console.log(err),
        
        /* dispatch({
            type: GET_ERRORS,
            payload: err.response
        }) */
    );
}
