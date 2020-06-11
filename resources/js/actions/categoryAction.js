import axios from 'axios';
import {GET_ERRORS, GET_CATEGORIES,GET_PROCATEGORIES} from './types';

export const getCategories  = () => dispatch => {
    axios.get('/api/get-categories')
    .then(res => {       
        dispatch({
            type: GET_CATEGORIES,
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
export const proCategory  = () => dispatch => {
    axios.get('/api/get-proCategory')
    .then(res => {        
        dispatch({
            type: GET_PROCATEGORIES,
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