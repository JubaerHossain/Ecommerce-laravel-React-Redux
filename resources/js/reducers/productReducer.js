import {GET_PRODUCTS,UNMOUNT_PRODUCTS,GET_PRODUCT,GET_CAT_PRODUCTS,GET_DIS_PRODUCT} from '../actions/types';

const initialState = {
    products:{},
    product:{},
    category:{},
    discount_product:{},
    loading:false
}
export default function(state = initialState, action){
        
    switch(action.type){
        case GET_PRODUCTS:  
         
        return {
            ...state,
            products:action.payload
        }
        case GET_PRODUCT:                
        return {
            ...state,
            product: action.payload
        }
        case GET_CAT_PRODUCTS:
        return {
            ...state,
            category: action.payload
        }
        case GET_DIS_PRODUCT:            
        return {
            ...state,
            discount_product: action.payload
        }
        case UNMOUNT_PRODUCTS:
        return {
            ...state,
            products:{}
        }
        default:
            return state;
    }
}