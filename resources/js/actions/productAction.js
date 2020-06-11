import axios from 'axios';
import {GET_ERRORS, GET_PRODUCTS,GET_PRODUCT, UNMOUNT_PRODUCTS,GET_CAT_PRODUCTS,GET_DIS_PRODUCT} from './types';

export const getProduct  = () => dispatch => {
    axios.get('/api/get-products')
    .then(res => 
        dispatch({
            type: GET_PRODUCTS,
            payload: res.data
        })    
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}
export const getCategoryProduct  = (string) => dispatch => {
    axios.get(`/api/get-categories/${string}`)
    .then(res => 
        dispatch({
            type: GET_CAT_PRODUCTS,
            payload: res.data
        })    
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}
export const getSingleProduct  = (slug) => dispatch => {    
    axios.get(`/api/get-product/${slug}`)    
    .then(res => 
        
        dispatch({
            type: GET_PRODUCT,
            payload: res.data
        })    
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}

export const getDiscountProduct  = () => dispatch => {
    axios.get('/api/get-discount-products')
    .then(res => {                
        dispatch({
            type: GET_DIS_PRODUCT,
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
export const unmountProduct =() =>{
    return {
        type: UNMOUNT_PRODUCTS,
    }
}