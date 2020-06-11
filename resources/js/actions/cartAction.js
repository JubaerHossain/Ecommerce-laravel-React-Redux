import axios from 'axios';
import {ADD_CART_PRODUCT,RESTORE_CART, SUBMIT_CART , DELETE_CART_PRODUCT, ADD_CART_PRODUCT_QTY,MINUS_CART_PRODUCT_QTY, CART_MESSAGE} from './types';

export const restoreOldCart  = (oldCart) => dispatch => {
    dispatch({
        type: RESTORE_CART,
        payload: oldCart
    })
}
export const deleteProduct  = (id) => dispatch => {
    dispatch({
        type: DELETE_CART_PRODUCT,
        payload: id
    })
}
export const addQty  = (item) => dispatch => {
    dispatch({
        type: ADD_CART_PRODUCT_QTY,
        payload: item
    })
}
export const minusQty  = (item) => dispatch => {
    dispatch({
        type: MINUS_CART_PRODUCT_QTY,
        payload: item
    })
}
export const addCartProduct  = (item) => dispatch => {
    dispatch({
        type: ADD_CART_PRODUCT,
        payload: item
    })
}
export const postCartProducts  = (order) => dispatch => {
    axios.post('/api/set-order', order)
    .then(res => {
        console.log(res.data)    
    }
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}