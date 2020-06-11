import axios from 'axios';
import {GET_ERRORS, GET_CAT_PRODUCT} from './types';

export const CatProducts  = (slug) => dispatch => { 
       
    axios.get(`/api/get-category-products/${slug}`)
    .then(res => {                         
        dispatch({
            type: GET_CAT_PRODUCT,
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