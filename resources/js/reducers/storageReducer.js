import {GET_STORAGE,GET_WARHOUSE} from '../actions/types';

const initialState = {
    marchants:{},
    warhouses:{},
    loading:false
}
export default function(state = initialState, action){   
    
                                  
    switch(action.type){
        case GET_STORAGE:
        return {
            ...state,
            marchants:action.payload
        }
        case GET_WARHOUSE:
        return {
            ...state,
            warhouses:action.payload
        }
        default:
            return state;
    }
}