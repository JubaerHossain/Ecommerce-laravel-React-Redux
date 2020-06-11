import {GET_CAT_PRODUCT} from '../actions/types';

const initialState = {
    cat_products:{},
    loading:false
}
export default function(state = initialState, action){
        
    switch(action.type){
        case GET_CAT_PRODUCT:           
        return {
            ...state,
            cat_products:action.payload
        }
        default:
            return state;
    }
}