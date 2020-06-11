import {GET_CATEGORIES,GET_PROCATEGORIES} from '../actions/types';

const initialState = {
    categories:{},
    procategory:{},
    loading:false
}
export default function(state = initialState, action){      
        
    switch(action.type){
        case GET_CATEGORIES:
        return {
            ...state,
            categories:action.payload
        }
        case GET_PROCATEGORIES:            
        return {
            ...state,
            procategory:action.payload
        }
        default:
            return state;
    }
}